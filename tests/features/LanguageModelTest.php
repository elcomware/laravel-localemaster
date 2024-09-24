<?php

namespace Elcomware\LocaleMaster\Tests;

use Elcomware\LocaleMaster\Models\Locale;
use Elcomware\LocaleMaster\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    Auth::login($this->user);
});

it('can create language', function () {
    //arrange
    $locale = 'en';
    //act
    $lang = Locale::create([
        'name' => 'English',
        'code' => 'en',
    ]);
    //asset
    expect($lang->code)->toBe('en') and
    expect($lang->creator)->toBe(1) and
    expect($lang->name)->tobe('English');

});
