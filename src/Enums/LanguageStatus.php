<?php

namespace Elcomware\LocaleMaster\Enums;

use Illuminate\Validation\Rules\Enum;

class LanguageStatus extends Enum
{
    const ACTIVE = ['active', 'Language is currently active'];
    const INACTIVE = ['inactive', 'Language is currently inactive'];
}
