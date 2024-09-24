<?php

namespace Elcomware\LocaleMaster\Actions;

use Elcomware\LocaleMaster\Models\Locale;

class LocaleMasterActions
{
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Locale::all();
    }

    public function getOne(Locale $lang)
    {
        return Locale::where('code', $lang->code)
            ->where('name', $lang->name)->first();
    }

    public function update(Locale $lang)
    {
        return '';

    }
}
