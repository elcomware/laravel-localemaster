<?php

namespace Elcomware\LocaleMaster\Tests;

use Elcomware\LocaleMaster\LocaleMaster;
use Elcomware\LocaleMaster\Models\Locale;
use Illuminate\Support\Facades\App;

beforeEach(function () {

    Locale::create([
        'name' => 'English',
        'code' => 'en',
    ]);
});

it('formats currency correctly', function () {
    $amount = 100000;
    $locale = 'en'; // Example locale

    App::setLocale($locale);
    $formattedCurrency = LocaleMaster::formatCurrency($amount);

    expect($formattedCurrency)->toBe('100,000.00 FCFA');
});
it('formats currency with currency first', function () {

    Locale::create([
        'name' => 'French',
        'code' => 'fr',
        'currency_first' => true,
    ]);

    $amount = 100000;
    $locale = 'fr';

    App::setLocale($locale);
    $formattedCurrency = LocaleMaster::formatCurrency($amount);

    expect($formattedCurrency)->toBe('FCFA 100,000.00');
});

it('formats number correctly', function () {
    $number = 1234567.89;
    $locale = 'en'; // Example locale

    App::setLocale($locale);
    $formattedNumber = LocaleMaster::formatNumber($number);

    expect($formattedNumber)->toBe('1,234,567.89');
});
