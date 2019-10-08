<?php

namespace App\Http\Controllers;

use App\Madadju;
use App\Rules\NationalCode;
use App\Rules\PersianDate;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MadadjuController extends Controller
{

    public function __construct()
    {
        $this->middleware('operator');
    }

    public function index(Request $request)
    {
        $query = Madadju::query();
        if ($request->full_name) {
            $phrase = $request->full_name_type == 'like' ? "%$request->full_name%" : $request->full_name;
            $query = $query->where('full_name', $request->full_name_type, $phrase);
        }

        if ($request->age) {

            $query = $query->whereRaw("TIMESTAMPDIFF(YEAR, birthday, CURDATE()) >= $request->age");
            $query = $query->whereRaw("TIMESTAMPDIFF(YEAR, birthday, CURDATE()) < ". ($request->age + 1));

        }elseif ($request->age_1 || $request->age_2) {

            // $date1 = Carbon::now()->subYears($request->age_1);
            // $date2 = $request->age_2 ? Carbon::now()->subYears($request->age_2) : null;
            $query = $query->whereNotNull('birthday');

            if ($request->age_1) {
                $query = $query->whereRaw("TIMESTAMPDIFF(YEAR, birthday, CURDATE()) >= $request->age_1");
            }
            if ($request->age_2) {
                $query = $query->whereRaw("TIMESTAMPDIFF(YEAR, birthday, CURDATE()) < $request->age_2");
            }

            // $query = $query->whereAge('birthday', '>=', 20);
        }

        if ($request->national_code) {
            $query = $query->where('national_code', 'like', "$request->national_code%");
        }

        if ($request->description) {
            $query = $query->whereNotNull('description');
        }

        $madadjus = $query->paginate(25);
        return view('madadjus.index', compact('madadjus'));
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
            "full_name" => "required|string",
            "father_name" => "nullable|string",
            "birthday" => [
                "nullable",
                new PersianDate
            ],
            "national_code" => [
                "required",
                "unique:madadjus,national_code,$id",
                new NationalCode,
            ],
        ]);

        $data['birthday'] = persian_to_carbon($data['birthday']);

        return $data;
    }
}