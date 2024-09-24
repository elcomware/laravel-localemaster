<?php

namespace Elcomware\LocaleMaster\Facades;

use Illuminate\Support\Facades\Facade;

//static function setLocale(string $lang): void

/**
 * @see \Elcomware\LocaleMaster\LocaleMaster
 */
class LocaleMaster extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return \Elcomware\LocaleMaster\LocaleMaster::class;
    }
}
