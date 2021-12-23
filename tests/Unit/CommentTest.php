<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Post;

class CommentTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_comment()
    {
        $post = Post::create(['title' => 'test', 'content' => 'test']);
        $data = ['post_id' => $post->id, 'author' => 'Aloware', 'content' => 'test comment'];
        $response = $this->postJson('/api/comment', $data);
        $response
            ->assertStatus(201)
            ->assertJson(
                [
                    'post_id' => $post->id,
                    'author' => 'Aloware',
                    'content' => 'test comment',
                    'parent_id' => null,
                ]
            );
    }
}
