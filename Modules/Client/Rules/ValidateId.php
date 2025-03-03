<?php

namespace Modules\Client\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateId implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        
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
        $id_digits = str_split($value);
        if (count($id_digits)!=13){ return false; };

        for ($i=count($id_digits)-2;$i >= 0 ; $i-=2 ){
            $temp_value=$id_digits[$i];
            $temp_value*=2;
            if($temp_value>9){$temp_value=$temp_value%10+1;}
            $id_digits[$i]=$temp_value;
        }

        $total=0;
        for($k=0;$k<count($id_digits);$k++){
            $total+=$id_digits[$k];
        }
        if ($total%10==0){
            return true;
        }else {return false;}
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Not a valid South African ID number';
    }
}
