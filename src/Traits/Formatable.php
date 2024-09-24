<?php

namespace Elcomware\LocaleMaster\Traits;

use Elcomware\LocaleMaster\LocaleMaster;
use Elcomware\LocaleMaster\Models\Locale;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

trait Formatable
{
    public static function formatCurrency(float $amount): string
    {

        $locale = self::getLocale(App::getLocale());
        // Format the number to include commas and two decimal points
        $formattedAmount = number_format(
            $amount,
            $locale['precision'],
            $locale['decimalSeparator'],
            $locale['thousandSeparator']
        );

        // Concatenate the formatted amount with the currency symbol
        if ($locale['currencyFirst']) {
            return "{$locale['currencySymbol']} {$formattedAmount}";
        }

        return "{$formattedAmount} {$locale['currencySymbol']}";
    }

    public static function formatNumber(float $number): string
    {
        $locale = self::getLocale(App::getLocale());

        // Format the number to include commas and two decimal points
        return number_format(
            $number,
            $locale['precision'],
            $locale['decimalSeparator'],
            $locale['thousandSeparator']
        );

    }

    private static function getLocale(string $locale): array
    {
        $data = Locale::where('code', $locale)
            ->where('is_active', true)
            ->first();
        if ($data !== null) {
            return [
                'precision' => $data->precision,
                'decimalSeparator' => $data->decimal_separator,
                'thousandSeparator' => $data->thousand_separator,
                'currencySymbol' => $data->currency_symbol,
                'currencyFirst' => $data->currency_first,
            ];
        } else {
            $data = LocaleMaster::defaultLocales();
            Log::info('default locale set');

            return [
                'precision' => $data['precision'],
                'decimalSeparator' => $data['decimal_separator'],
                'thousandSeparator' => $data['thousand_separator'],
                'currencySymbol' => $data['currency_symbol'],
                'currencyFirst' => $data['currency_first'],
            ];
        }

    }
}
