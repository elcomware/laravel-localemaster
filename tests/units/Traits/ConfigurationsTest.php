<?php

namespace Elcomware\LocaleMaster\Tests;

use Elcomware\LocaleMaster\LocaleMaster;
use Illuminate\Support\Facades\Config;

it('can gets correct language table from config', function () {
    //arrange
    $tableName = Config::get('localemaster.tables.locale');
    //act
    $table = LocaleMaster::localesTable();
    //asset
    expect($table)->toBe($tableName);

});

it('can gets language table when Not set in config', function () {
    //arrange
    Config::set('localemaster.tables.locale', null);
    //act
    $table = LocaleMaster::localesTable();
    //asset
    expect($table)->not->toBeNull();

});
