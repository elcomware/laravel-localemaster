<?php

namespace Elcomware\LocaleMaster\Contracts;

use Elcomware\LocaleMaster\Models\Locale;

interface LocaleCreater
{
    public function create(LocaleUser $user, array $input): Locale|\Exception;
}
