<?php

use Elcomware\LocaleMaster\Enums\TextDirection;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private static function commonFields(Blueprint $table): void
    {
        $table->foreignId('create_by')->after('created_at')->nullable()->constrained('users');
        $table->foreignId('last_edited_by')->nullable()->constrained('users');
        $table->unsignedBigInteger('version')->nullable()->default(1);
    }

    public function up(): void
    {
        Schema::create('localemaster_languages', function (Blueprint $table) {
            $table->id();
            $table->string('code', length: 10)->unique(); // Language code (e.g., 'en')
            $table->string('name', length: 100); // English name of the language
            $table->string('native_name', length: 100); // Native name of the language
            $table->enum('direction', TextDirection::getTextDirection())
                ->default(TextDirection::LTR); // Text direction
            $table->string('flag')->nullable(); // URL or path to flag image
            $table->string('identifier', length: 10); // Locale identifier (e.g., 'en_US')

            $table->string('number_separator',length:5 )->default('.'); // , or .
            $table->unsignedTinyInteger('number_precision' )->default(2); // 0.00
            $table->unsignedTinyInteger('number_max_precision' )->default(5); // 0.00000

            $table->string('currency_symbol', length: 10); // FCFA for dollar
            $table->string('currency_name', length: 25); // Franc
            $table->unsignedTinyInteger('currency_precision')->default(2); // 0.00
            $table->string('currency_seperator', length: 5)->default('.'); // 0.00
            $table->unsignedTinyInteger('currency_max_precision')->default(2); // 0.00
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
        Schema::dropIfExists('localemaster_languages');
    }
};
