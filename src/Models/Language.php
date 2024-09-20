<?php

namespace Elcomware\LocaleMaster\Models;

use Elcomware\LocaleMaster\Enums\TextDirection;
use Elcomware\LocaleMaster\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    use Translatable;

    protected $fillable = [
        'code', 'name', 'native_name', 'direction', 'flag', 'identifier',
        'number_separator', 'number_precision', 'number_max_precision',
        'currency_symbol', 'currency_name', 'currency_precision', 'currency_seperator',
        'currency_max_precision', 'currency_first',
        'is_active', 'is_default',
    ];

    protected array $translatedAttributes = [
        'name',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_default' => 'boolean',
            'currency_first' => 'boolean',
            'direction' => TextDirection::class,
        ];
    }
}
