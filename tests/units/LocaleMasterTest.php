<?php

namespace Elcomware\LocaleMaster\Tests;

use Elcomware\LocaleMaster\LocaleMaster;
use Elcomware\LocaleMaster\Models\Locale;
use Elcomware\LocaleMaster\Traits\Configurations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

use function Pest\Laravel\assertDatabaseCount;

uses(RefreshDatabase::class);

it("can set 'en' as default locale", function () {
    //arrange
    //act
    LocaleMaster::setLocale('fr');
    $appLocale = App::getLocale();
    $sessionLocale = Session::get('locale');
    $carbonLocale = Carbon::getLocale();
    //asset
    expect($appLocale)->toBe('en') and
    expect($sessionLocale)->toBe('en') and
    expect($carbonLocale)->toBe('en');
});

it('can get locale from db', function () {
    //arrange
    Locale::create([
        'name' => 'French',
        'code' => 'fr',
    ]);
    Locale::create([
        'name' => 'English',
        'code' => 'en',
    ]);

    $locale = 'fr';

    //act
    LocaleMaster::setLocale($locale);
    $appLocale = App::getLocale();
    $sessionLocale = Session::get('locale');
    $carbonLocale = Carbon::getLocale();
    //asset
    expect($appLocale)->toBe($locale) and
    expect($sessionLocale)->toBe($locale) and
    expect($carbonLocale)->toBe($locale);
});

it("can NOT set 'others' as locale", function () {
    //arrange
    $locale = 'others';

    //act
    LocaleMaster::setLocale($locale);
    $appLocale = App::getLocale();
    $sessionLocale = Session::get('locale');
    $carbonLocale = Carbon::getLocale();
    //asset
    expect($appLocale)->not->toBe($locale) and
    expect($sessionLocale)->not->toBe($locale) and
    expect($carbonLocale)->not->toBe($locale);
});

it('can get all locales', function () {

    //arrange
    Locale::create([
        'name' => 'French',
        'code' => 'fr',
    ]);
    Locale::create([
        'name' => 'English',
        'code' => 'en',
    ]);

    //$lang = Locale::factory()->create();

    $locales = LocaleMaster::getAllLocales();
    assertDatabaseCount(Configurations::localesTable(), 2);
    expect($locales->count())->toBe(2);
});

it('can get active locales', function () {

    //arrange
    Locale::create([
        'name' => 'French',
        'code' => 'fr',
        'is_active' => false,
    ]);
    Locale::create([
        'name' => 'English',
        'code' => 'en',
    ]);

    //$lang = Locale::factory()->create();

    $locales = LocaleMaster::getActiveLocales();
    assertDatabaseCount(Configurations::localesTable(), 2);
    expect($locales->count())->toBe(1);
});

it('can get inactive locales', function () {
    //arrange
    Locale::create([
        'name' => 'French',
        'code' => 'fr',
        'is_active' => false,
    ]);
    Locale::create([
        'name' => 'English',
        'code' => 'en',
    ]);

    //$lang = Locale::factory()->create();

    $locales = LocaleMaster::getInActiveLocales();
    assertDatabaseCount(Configurations::localesTable(), 2);
    expect($locales->count())->toBe(1);
});

it('can format number by en locale', function () {
    //arrange
    Locale::create([
        'name' => 'French',
        'code' => 'fr',
        'number_separator' => ',',
    ]);
    Locale::create([
        'name' => 'English',
        'code' => 'en',
        'number_separator' => '.',
    ]);

    //act
    LocaleMaster::setLocale('en');
    //$lang = Locale::factory()->create();

    $number = LocaleMaster::formatNumber(100000);
    $currency = LocaleMaster::formatCurrency(100000);
    expect($number)->toBe('100,000.00') and
    expect($currency)->toBe('100,000.00 FCFA');
});
