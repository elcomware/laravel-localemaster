<?php

use Elcomware\LocaleMaster\Enums\TextDirection;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private static function commonFields(Blueprint $table): void
    {
        $table->id();
        $table->foreignId('create_by')->nullable()->constrained('users');
        $table->foreignId('last_edited_by')->nullable()->constrained('users');
        $table->unsignedBigInteger('version')->nullable()->default(1);
    }

    public function up(): void
    {
        Schema::create('localemaster_languages', function (Blueprint $table) {
            static::commonFields($table);
            $table->string('code', length: 10)->unique(); // Language code (e.g., 'en')
            $table->string('name', length: 100); // English name of the language
            $table->string('native_name', length: 100); // Native name of the language
            $table->enum('direction', TextDirection::getTextDirection())
                ->default(TextDirection::LTR); // Text direction
            $table->string('flag')->nullable(); // URL or path to flag image
            $table->string('identifier', length: 10); // Locale identifier (e.g., 'en_US')
            $table->boolean('is_active')->default(true); // Whether the language is active
            $table->boolean('is_default')->default(false); // Whether the language is default

            // add fields

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('localemaster_languages');
    }
};
