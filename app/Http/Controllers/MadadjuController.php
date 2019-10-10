<?php

namespace App\Http\Controllers;

use App\Madadju;
use App\User;
use App\Introduce;
use App\Rules\NationalCode;
use App\Rules\PersianDate;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MadadjuController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('operator')->except('show');
    }

    public function index(Request $request)
    {
        $query = Madadju::query();

        // national code
        if ($phrase = $request->national_code) {
            $query = $query->where('national_code', 'like', "$phrase%");
        }

        // age
        if ($request->age) {

            $query = $query->whereRaw("TIMESTAMPDIFF(YEAR, birthday, CURDATE()) >= $request->age");
            $query = $query->whereRaw("TIMESTAMPDIFF(YEAR, birthday, CURDATE()) < ". ($request->age + 1));

        }elseif ($request->age_1 || $request->age_2) {

            $query = $query->whereNotNull('birthday');

            if ($request->age_1) {
                $query = $query->whereRaw("TIMESTAMPDIFF(YEAR, birthday, CURDATE()) >= $request->age_1");
            }
            if ($request->age_2) {
                $query = $query->whereRaw("TIMESTAMPDIFF(YEAR, birthday, CURDATE()) < $request->age_2");
            }

        }

        // first name or last name
        if ($phrase = $request->full_name) {
            $query = $query->where(function ($query) use ($phrase) {
                $query->where('first_name', 'like', "%$phrase%")->orWhere('last_name', 'like', "%$phrase%");
            });
        }

        // gender
        if ($request->male !== null) {
            $query = $query->where('male', $request->male);
        }

        // education grade
        if ($phrase = $request->education_grade) {
            $query = $query->where('education_grade', $phrase);
        }

        // education filed
        if ($phrase = $request->education_filed) {
            $query = $query->where('education_filed', $phrase);
        }

        // married or single
        if ($request->married != null) {
            $query = $query->where('married', $request->married);
        }

        $madadjus = $query->paginate(25);
        $organs = User::where('type', 'organ')->get();
        return view('madadjus.index', compact('madadjus', 'organs'));
    }

    public function show(Madadju $madadju)
    {
        return view('madadjus.show', compact('madadju'));
    }

    public function create()
    {
        $madadju = new Madadju;
        return view('madadjus.create', compact('madadju'));
    }

    public function store(Request $request)
    {
        $data = self::validation();
        Madadju::create($data);
        return back()->withMessage('مددجو جدید اضافه شد.');
    }

    public function edit(Madadju $madadju)
    {
        return view('madadjus.create', compact('madadju'));
    }

    public function update(Request $request, Madadju $madadju)
    {
        $data = self::validation($madadju->id);
        $madadju->update($data);
        return redirect('madadju')->withMessage('مددجو موردنظر ویرایش شد.');
    }

    public function destroy(Madadju $madadju)
    {
        $madadju->delete();
        return back()->withMessage('مددجوی موردنظر از سیستم حذف شد.');
    }

    public static function validation($id=0)
    {
        $data =  request()->validate([
            "first_name" => "required|string",
            "last_name" => "required|string",
            "national_code" => [
                "required",
                "unique:madadjus,national_code,$id",
                new NationalCode,
            ],
            "birthday" => [
                "nullable",
                new PersianDate
            ],
            "male" => "required|boolean",
            "education_grade" => "required|string",
            "education_field" => "nullable|string",
            "skill" => "nullable|string",
            "favourites" => "nullable|string",
            "region" => "nullable|integer",
            "insurance_number" => "nullable|string",
            "telephone" => "nullable|string",
            "mobile" => "required|string",
            "married" => "required|boolean",
            "military_status" => "required|string",
            "warden_name" => "required|string",
            "muid" => "required|string",
            "address" => "required|string",
            "warden_national_code" => [
                "required",
                new NationalCode,
            ],
        ]);

        $data['birthday'] = persian_to_carbon($data['birthday']);

        return $data;
    }
}
