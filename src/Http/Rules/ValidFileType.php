<?php

namespace DcodeGroup\Fileman\Http\Rules;

use Closure;
use DcodeGroup\Fileman\Services\FileService;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class ValidFileType implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /**
         * $value is an instance of Illuminate\Http\UploadedFile
         */
        if (! resolve(FileService::class)->isValidFileTypes($value->getMimeType())) {
            $fail(__('fileman.words.invalid_file_type', ['type' => $value->getMimeType()]));
        }
    }
}
