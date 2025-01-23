<?php

namespace Tests\Feature;

use Tests\TestCase;

class TranslationFeatureTest extends TestCase
{
    public function test_create_translation_api()
    {
        $response = $this->postJson('/api/translations', [
            'locale' => 'en',
            'key' => 'welcome_message',
            'content' => 'Welcome to our app',
        ]);

        $response->assertStatus(201);
    }
}

