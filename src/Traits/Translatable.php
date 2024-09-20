<?php

namespace Elcomware\LocaleMaster\Traits;

use Illuminate\Support\Facades\App;

trait Translatable
{
    public function getTranslatedAttribute($attribute)
    {
        $locale = App::getLocale();
        $translations = $this->attributes['translations'] ?? [];

        return $translations[$locale][$attribute] ?? $this->{$attribute};
    }

    public function setTranslatedAttribute($attribute, $value): void
    {
        $locale = App::getLocale();
        $translations = $this->attributes['translations'] ?? [];

        $translations[$locale][$attribute] = $value;

        $this->attributes['translations'] = json_encode($translations);
    }
}
