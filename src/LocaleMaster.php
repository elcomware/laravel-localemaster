<?php

namespace Elcomware\LocaleMaster;

use Elcomware\LocaleMaster\Models\Locale;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleMaster
{
    use Traits\Configurations;
    use Traits\Formatable;
    use Traits\HasModels;
    use Traits\Translatable;

    public function __construct() {}

    public static function setLocale(string $lang): void
    {

        // Fetch all active languages from the database
        //$activeLanguages = Locale::where('is_active', true); // Get only the codes
        $activeLanguages = Locale::where('is_active', true)->where('code', $lang)->pluck('code');

        //if locale not found, get default locale
        $appLocale = $activeLanguages[0] ?? LocaleMaster::defaultLocale();

        //set locales
        App::setLocale($appLocale);
        Session::put('locale', $appLocale);
        Carbon::setLocale($appLocale);

    }

    public static function getCurrentLocale()
    {
        $locale = App::getLocale();

        return Locale::where('code', $locale)->first();
    }

    public static function getOneLocale(Locale $lang)
    {
        return Locale::where('code', $lang->code)
            ->where('name', $lang->name)
            ->first();
    }

    public static function getAllLocales(): Collection
    {
        return Locale::all();
    }

    public static function getActiveLocales(): Collection
    {
        return Locale::where('is_active', true)->get();
    }

    public static function getInActiveLocales(): Collection
    {
        return Locale::where('is_active', false)->get();

    }
}
