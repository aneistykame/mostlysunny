<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidEmailDomain implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
{
    $domain = substr(strrchr($value, "@"), 1);

    if (!str_contains($domain, '.')) {
        $fail('Tento e-mail má neplatnú doménu.');
        return;
    }

    if (!@checkdnsrr($domain, 'MX')) {
        $fail('Doména ' . $domain . ' neexistuje.');
    }
}
}