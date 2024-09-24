<?php

namespace Elcomware\LocaleMaster\Models;

use Elcomware\LocaleMaster\Enums\TextDirection;
use Elcomware\LocaleMaster\LocaleMaster;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Locale extends LocaleMasterModel
{
    use HasFactory;

    public function __construct()
    {
        parent::__construct();

        // Dynamically set the table name from config
        $this->setTable(LocaleMaster::localesTable());

    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $fillable = [
        'code', 'name', 'native_name', 'direction', 'flag', 'identifier',
        'decimal_separator', 'precision', 'thousand_separator',
        'currency_symbol', 'currency_name', 'currency_first',
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
