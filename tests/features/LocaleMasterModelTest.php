<?php

use Elcomware\LocaleMaster\Models\LocaleMasterModel;
use Elcomware\LocaleMaster\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

    expect($model->created_by)->toBe($this->user->id)
        ->and($model->last_edited_by)->toBe($this->user->id)
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

    expect($model->last_edited_by)->toBe($this->user->id)
        ->and($model->version)->toBe(2);
});
