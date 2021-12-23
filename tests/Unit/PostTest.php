<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_post_has_right_data()
    {
        $response = $this->getJson('/api/post');

        $response
            ->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) => $json
                    ->hasAll('id', 'title', 'content', 'image_url', 'comments', 'comments_count', 'content', 'created_at', 'updated_at')
            );
    }
}
