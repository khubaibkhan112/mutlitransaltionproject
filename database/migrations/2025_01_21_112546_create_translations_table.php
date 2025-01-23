<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 10); // Limit locale to 10 characters (e.g., "en_US").
            $table->string('key'); // Translation key (e.g., "welcome_message").
            $table->text('content'); // Translation content (e.g., "Welcome to our app").
            $table->timestamps();

            // Add a composite unique constraint to prevent duplicate translations.
            $table->unique(['locale', 'key']);
        });

        // Separate table for tagging translations with context (e.g., mobile, desktop).
        Schema::create('translation_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('translation_id')->constrained()->cascadeOnDelete();
            $table->string('tag');
            $table->timestamps();

            // Ensure unique tags per translation.
            $table->unique(['translation_id', 'tag']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('translation_tags');
        Schema::dropIfExists('translations');
    }
}
