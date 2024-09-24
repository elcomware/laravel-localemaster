<?php

namespace Elcomware\LocaleMaster\Contracts;

use Elcomware\LocaleMaster\Models\Locale;
use Illuminate\Database\Eloquent\Model;

interface LocaleCreater
{
    public function create(LocaleUser $user, array $input): Locale | \Exception;

}
