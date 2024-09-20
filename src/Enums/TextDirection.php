<?php

namespace Elcomware\LocaleMaster\Enums;

enum TextDirection: string
{
    case LTR = 'ltr';
    case RTL = 'rtl';

    public static function getTextDirection(): array
    {
        return [
            self::RTL->value,
            self::LTR->value,
        ];

    }
}
