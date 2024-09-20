<?php

namespace Elcomware\LocaleMaster;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LocaleMaster {

    //protected mixed $supportedLocales;
    protected mixed $currentLocale;
    protected mixed $numberFormatter;
    protected mixed $currencyFormatter;

    public function __construct()
    {

    }

    public static function listLocales()
    {


    }

    public static function setLocale($locale): void
    {
        $defaultLocale = Config::get('localemaster.default_locale', 'en');
        $supportedLocales = Config::get('localemaster.supported_locales', $defaultLocale);

        if (in_array($locale, $supportedLocales)) {
            App::setLocale($locale);
            Session::put('locale', $locale);
            Carbon::setLocale($locale);
        }
    }

    public static function formatNumber()
    {

    }

    public function getLocale(): string
    {
        return App::getLocale();
    }
}
