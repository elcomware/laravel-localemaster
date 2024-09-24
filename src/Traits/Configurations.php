<?php

namespace Elcomware\LocaleMaster\Traits;

use Elcomware\LocaleMaster\Enums\TextDirection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

trait Configurations
{

    public static array $permissions;

    public static function defaultLocales()
    {
        $default = [
            'code' => 'en',
            'name' => 'English',
            'native_name' => 'English',
            'direction' => TextDirection::LTR->value,
            'flag' => '',
            'identifier' => 'en_CM',
            'precision' => 2,
            'decimal_separator' => '.',
            'thousand_separator' => ',',
            'currency_symbol' => 'FCFA',
            'currency_name' => 'Franc',
            'currency_first' => false,
            'is_active' => true,
            'is_default' => true,
        ];
        $locale = Config::get('localemaster.default_locale');
        if (empty($locale)) {
            Log::error('default locale not missing');

            return $default;
        }

        return $locale;

    }

    public static function localesTable()
    {
        return Config::get('localemaster.tables.locale', 'localemaster_locales');
    }

    public static function defaultLocale()
    {
        return Config::get('localemaster.defaults.locale', 'en');
    }

    public static function userModel()
    {
        return Config::get('localemaster.models.user', 'App\\Models\\User');
    }

    public static function permissionModel()
    {
        return Config::get('localemaster.models.permission', 'App\\Models\\Permission');
    }


    public static function permissions()
    {
        self::$permissions = Config::get('localemaster.permissions');

        return self::$permissions;
    }



}
