<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PersianDate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $numbers = explode('/', $value);
        if (count($numbers) == 3) {

            $year = $numbers[0];
            $month = $numbers[1];
            $day = $numbers[2];

            return ($year > 1000) && ($month >= 1 && $month <= 12 ) && ($day >= 1 && $day <= 31);

        }else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'تاریخ وارد شده صحیح نیست.';
    }
}
