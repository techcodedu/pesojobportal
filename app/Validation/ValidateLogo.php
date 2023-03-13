<?php

namespace App\Validation\Rules;
use CodeIgniter\Validation\Rules\File;

class ValidateLogo
{
    public function validate($value, string $error = null): bool
    {
        if (empty($value))
        {
            return false;
        }
        return parent::validate($value, $error);
    }
}
