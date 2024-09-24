<?php

namespace Elcomware\LocaleMaster\Traits;

use Elcomware\LocaleMaster\Exceptions\ExceptionCodes;

trait Translatable
{
    // Array to hold the names of translation fields
    protected array $translationFields = [];

    // Method to set a translation field
    public function setTranslationField($field): void
    {
        $this->translationFields[] = $field;
    }

    // Method to get a translation for a specific field and locale
    public function getTranslation($field, $locale)
    {
        if (! in_array($field, $this->translationFields)) {
            throw new \Exception(code: ExceptionCodes::TRANSLATION_FIELD_UNDEFINED);
        }

        return $this->$field[$locale] ?? null;
    }

    // Method to set a translation for a specific field and locale

    public function setTranslation(string $field, string $locale, mixed $value): void
    {
        if (! in_array($field, $this->translationFields)) {
            throw new \Exception(code: ExceptionCodes::TRANSLATION_FIELD_UNDEFINED);
        }

        // Store the translation and save the model
        //$this->{$field}[$locale] = $value;

        $this->$field = [$locale => $value];

        $this->save();
    }

    // Method to set multiple translations for a specific field
    public function setTranslations($field, array $translations): void
    {
        if (! in_array($field, $this->translationFields)) {
            throw new Exception(code: ExceptionCodes::TRANSLATION_FIELD_UNDEFINED);
        }

        // Retrieve the current translations or initialize an empty array if null
        $currentTranslations = $this->{$field} ?? [];

        // Loop through the new translations
        foreach ($translations as $locale => $value) {
            // Update the translations
            $currentTranslations[$locale] = $value;
        }

        // Set the updated translations back to the model
        $this->{$field} = $currentTranslations;

        // Save the model once after updating all translations
        $this->save();

    }

    // Method to retrieve all translations for a specific field
    public function getTranslations($field)
    {
        if (! in_array($field, $this->translationFields)) {
            throw new \Exception(code: ExceptionCodes::TRANSLATION_FIELD_UNDEFINED);
        }

        return $this->{$field} ?? [];
    }
}
