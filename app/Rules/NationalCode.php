<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NationalCode implements Rule
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
        if(strlen($value) != 10 ) return false;
        $sum = 0;
        for ($i=-10; $i < 0 ; $i++) {
            $number = substr($value, $i, 1);
            if ( abs($i) > 1 ){
                $sum += abs($i) * $number;
            } else {
                $control_number = $number;
            }
        }

        $Q = floor($sum/11);
        $R = $sum%11;

        if( $R < 2 ){
            return $control_number == $R;
        }else {
            return $control_number == (11-$R);
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute صحیح نیست';
    }
}
