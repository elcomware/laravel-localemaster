<?php

use Elcomware\LocaleMaster\Enums\TextDirection;
use Elcomware\LocaleMaster\Traits\Configurations;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private static function commonFields(Blueprint $table): void
    {
        $table->foreignId('creator')->nullable()->constrained('users');
        $table->foreignId('last_editor')->nullable()->constrained('users');
        $table->unsignedBigInteger('version')->default(1);
    }

    public function up(): void
    {
        Schema::create(Configurations::localesTable(), function (Blueprint $table) {
            $table->id();
            $table->string('code', length: 3)->unique(); // Locale code (e.g., 'en')
            $table->string('name', length: 255); // English name of the language
            $table->string('native_name', length: 255)->nullable(); // Native name of the language
            $table->enum('direction', TextDirection::getTextDirection())
                ->default(TextDirection::LTR); // Text direction
            $table->string('flag')->nullable(); // URL or path to flag image
            $table->string('identifier', length: 10)->nullable(); // Locale identifier (e.g., 'en_US')

            $table->unsignedTinyInteger('precision')->default(2); // 0.00
            $table->string('decimal_separator', length: 5)->default('.'); // , or .
            $table->string('thousand_separator', length: 5)->default(','); //

            $table->string('currency_symbol', length: 10)->default('FCFA'); // FCFA for dollar
            $table->string('currency_name', length: 25)->default('Franc'); // Franc
            $table->boolean('currency_first')->default(false);

            $table->boolean('is_active')->default(true); // Whether the language is active
            $table->boolean('is_default')->default(false); // Whether the language is default

            // add fields
            static::commonFields($table);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(Configurations::localesTable());
    }
};
