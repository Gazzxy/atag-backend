<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DateMultiFormat implements Rule
{
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
        $formats = ['Y-m-d', 'Y-m-d H:i:s'];

        $passes = false;

        foreach($formats as $format)
        {
            $date = \DateTime::createFromFormat($format, $value);

            if(false !== $date)
            {
                $passes = true;

                break;
            }
        }

        return $passes;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Incorrect date format';
    }
}
