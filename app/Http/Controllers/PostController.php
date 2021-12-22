<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PostCommentRequest;
use Illuminate\Support\Facades\DB;
use function now;

final class PostController extends Controller
{
    /**
     * Get a single post including comments ordered by the latest
     *
     * @return object
     */
    public function index(): object
    {
        $post = DB::table('posts')->first();
        $post->comments = DB::table('comments')
            ->where('post_id', $post->id)
            ->orderByDesc('created_at')
            ->get();
        return $post;
    }

    /**
     * Validate and insert a single comment
     *
     * @return bool
     */
    public function createComment(PostCommentRequest $request): array
    {
        $comment = $request->validated();
        $comment['created_at'] = now();
        $result = DB::table('comments')->insert($comment);
        return ['created' => $result];
    }
}
