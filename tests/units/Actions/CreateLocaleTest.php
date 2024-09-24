<?php

use Elcomware\LocaleMaster\Actions\CreateLocale;
use Elcomware\LocaleMaster\Events\LocaleCreated;
use Elcomware\LocaleMaster\Events\LocaleCreating;
use Elcomware\LocaleMaster\Exceptions\ExceptionCodes;
use Elcomware\LocaleMaster\Models;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Mockery\MockInterface;
use Workbench\App\Models\User;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = \Workbench\App\Models\User::factory()->create();
    Auth::login($this->user);
    $this->createLocale = new CreateLocale;
});
afterEach(function () {
    Mockery::close();
});

it('creates a locale successfully', function () {

    // Mock authorization
    Gate::shouldReceive('forUser')
        ->with($this->user)
        ->andReturnSelf();
    Gate::shouldReceive('authorize')
        ->once()
        ->with('create', Models\Locale::class);

    // Mock event dispatching
    Event::fake();

    $input = [
        'name' => 'English',
        'code' => 'en',
    ];

    $locale = $this->createLocale->create($this->user, $input);

    expect($locale)->toBeInstanceOf(Models\Locale::class)
        ->and($locale)->save()
        ->and($locale->name)->toBe('English');

    // Assert events were dispatched
    Event::assertDispatched(LocaleCreating::class);
    Event::assertDispatched(LocaleCreated::class);
});

it('fails to create a locale with invalid input', function () {

    $input = []; // Invalid input

    $result = $this->createLocale->create($this->user, $input);

    expect($result)->toBeInstanceOf(Exception::class)
        ->and($result->getCode())->toBe(ExceptionCodes::REQUEST_INPUT_NOTFOUND);
});

it('throws an authorization exception when unauthorized', function () {
    $user = User::factory()->create();
    $input = [
        'name' => 'Spanish',
        'code' => 'es',
    ];

    Gate::shouldReceive('forUser')
        ->with($user)
        ->andReturnSelf();
    Gate::shouldReceive('allows')
        ->once()
        ->with('create', Models\Locale::class)
        ->andReturn(false);

    $result = $this->createLocale->create($user, $input);

    expect($result)->toBeInstanceOf(Exception::class)
        ->and($result->getCode())->toBe(ExceptionCodes::ACTION_NOT_AUTHORIZED);
});

it('handles exceptions during locale creation', function () {
    $input = [
        'name' => 'French',
        'code' => 'fr',
    ];

    Gate::shouldReceive('forUser')
        ->with($this->user)
        ->andReturnSelf();
    Gate::shouldReceive('allows')
        ->once()
        ->with('create', Models\Locale::class)
        ->andReturn(true);

    // Simulate an exception during creation

    $mock = $this->partialMock(Models\Locale::class, function (MockInterface $mock) {
        global $input;
        $mock->shouldReceive('create')
            ->once()->with($input)->andThrow(new Exception('Database Error'));
    });

    $result = $this->createLocale->create($this->user, $input);

    expect($result)->toBeInstanceOf(Exception::class)
        ->and($result->getMessage())->toBe('Database Error');
})->skip('temporarily unavailable');
