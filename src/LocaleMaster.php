<?php

namespace Elcomware\LocaleMaster;

use Elcomware\LocaleMaster\Models\Language;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Number;

class LocaleMaster
{
    //protected mixed $supportedLocales;
    protected mixed $currentLocale;

    protected mixed $numberFormatter;

    protected mixed $currencyFormatter;

    public function __construct() {}

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

    public static function getCurrentLocale(): string
    {
        $locale = App::getLocale();

        return Language::where('code', $locale)->first();
    }

    public static function getAllLocales(): Collection
    {
        return Language::all();
    }

    public static function getActiveLocales(): Collection
    {
        return Language::all()->reject(function (Language $lang) {
            return $lang->is_active === false;
        });
    }

    public static function getInActiveLocales(): Collection
    {
        return Language::all()->reject(function (Language $lang) {
            return $lang->is_active === true;
        });
    }

    public function formatNumber($number): false|string
    {
        $locale = static::getCurrentLocale();

        return Number::format(
            number: $number,
            precision: $locale->number_precision,
            maxPrecision: $locale->number_max_precision,
            locale: $locale->code
        );
    }

    public function formatCurrency($amount, $currencyCode): false|string
    {
        $locale = static::getCurrentLocale();

        return Number::currency(
            number: $amount,
            in: $locale->currency_symbol,
            locale: $locale->code
        );
    }
}
