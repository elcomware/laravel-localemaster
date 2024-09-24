<?php

namespace Elcomware\LocaleMaster\Rules;

use Closure;
use Elcomware\LocaleMaster\Models\Locale;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidLocale implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $validLocale = Locale::all()->reject(function (Locale $model) {
            return $model->is_active === false;
        })->map(function (Locale $model) {
            return $model->code;
        });

        if ($validLocale->contains('code', $value)) {
            $fail('localemaster.invalidLocale')->translate([
                'locale' => $value,
            ], 'en');
        }
    }
}
