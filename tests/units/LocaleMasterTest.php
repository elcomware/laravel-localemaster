<?php

namespace Elcomware\LocaleMaster\Tests;

use Elcomware\LocaleMaster\LocaleMaster;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

it("can set 'en' as locale", function () {
    //arrange
    $locale = 'en';
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

it("can set 'fr' as locale", function () {
    //arrange
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
