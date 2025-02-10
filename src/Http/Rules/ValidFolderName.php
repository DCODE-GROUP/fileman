<?php

namespace DcodeGroup\Fileman\Http\Rules;

use Closure;
use DcodeGroup\Fileman\Services\FolderService;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidFolderName implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! resolve(FolderService::class)->isValidFolderName($value)) {
            $fail(__('fileman.words.invalid_folder_name'));
        }
    }
}
