<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Support\Facades\Validator;

class dataImage implements Rule
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
     * @param string $value
     *
     * @return File
     */
    protected function convertToFile(string $value): File
    {
        if (strpos($value, ';base64') !== false) {
            [, $value] = explode(';', $value);
            [, $value] = explode(',', $value);
        }

        $binaryData = base64_decode($value);
        $tmpFile = tempnam(sys_get_temp_dir(), 'base64validator');
        file_put_contents($tmpFile, $binaryData);

        return new File($tmpFile);
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



    $newImg = $this->convertToFile($value);

   $v =  Validator::make(['img'=> $newImg],[
        'img'=>['image']
    ]);

    if($v->fails()){
        return false;
    } else{

        return true;
    }

}

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
