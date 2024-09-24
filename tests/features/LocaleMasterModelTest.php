<?php

use Elcomware\LocaleMaster\LocaleMaster;
use Elcomware\LocaleMaster\Models\Locale;
use Elcomware\LocaleMaster\Models\LocaleMasterModel;
use Elcomware\LocaleMaster\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    Auth::login($this->user);
});

it('sets created_by, updated_by, and version on create', function () {
    $model = new class extends LocaleMasterModel
    {
        protected $table = 'test_models';

        protected $guarded = [];
    };

    $model->name = 'John Doe';
    $model->save();

    expect($model->creator)->toBe($this->user->id)
        ->and($model->last_editor)->toBe($this->user->id)
        ->and($model->version)->toBe(1);
});

it('updates last_edited_by and increments version on update', function () {
    $model = new class extends LocaleMasterModel
    {
        protected $table = 'test_models';

        protected $guarded = [];
    };

    $model->name = 'John Doe';
    $model->save();

    $model->name = 'Jane Doe';
    $model->update();

    expect($model->last_editor)->toBe($this->user->id)
        ->and($model->version)->toBe(2);
});

it('formats currency correctly', function () {
    $amount = 100000;
    $locale = 'en'; // Example locale

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

    Locale::create([
        'name' => 'Unknown',
        'code' => 'un',
        'thousand_separator' => '-',
    ]);
    App::setLocale('un');

    $formattedNumber = LocaleMaster::formatNumber($number);

    expect($formattedNumber)->toBe('1-234-567.89');
});
