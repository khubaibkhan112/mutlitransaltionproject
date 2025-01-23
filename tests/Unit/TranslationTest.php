<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Translation;

class TranslationTest extends TestCase
{
    public function test_create_translation()
    {
        $translation = Translation::create([
            'locale' => 'en',
            'key' => 'welcome_message',
            'content' => 'Welcome to our app',
        ]);

        $this->assertDatabaseHas('translations', [
            'locale' => 'en',
            'key' => 'welcome_message',
        ]);
    }
}

