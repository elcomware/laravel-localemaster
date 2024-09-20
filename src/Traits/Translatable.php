<?php

namespace Elcomware\LocaleMaster\Traits;


use Elcomware\LocaleMaster\LocaleMaster;
use Illuminate\Support\Facades\App;

trait Translatable
{

    protected array $translatedAttributes;

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

    public function hasTranslations(array $attributes): void
    {
        $locale = App::getLocale();
         $this->translatedAttributes = $attributes??[];
    }

    public function getTranslations($attribute)
    {
        $locale = LocaleMaster::getCurrentLocale(); //App::getLocale();
        $translations = $this->translatedAttributes[$attribute] ?? [];

        return $translations[$locale] ?? $this->{$attribute};
    }
}
