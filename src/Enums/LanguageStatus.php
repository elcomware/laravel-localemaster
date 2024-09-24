<?php

namespace Elcomware\LocaleMaster\Enums;

use Illuminate\Validation\Rules\Enum;

class LanguageStatus extends Enum
{
    const ACTIVE = ['active', 'Locale is currently active'];

    const INACTIVE = ['inactive', 'Locale is currently inactive'];
}
