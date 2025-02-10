<?php

namespace DcodeGroup\Fileman\Http\Rules;

use Closure;
use DcodeGroup\Fileman\Services\FileService;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidFileName implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if (! resolve(FileService::class)->isValidFileNames($value)) {
            $fail(__('fileman.words.invalid_file_name'));
        }
    }
}
