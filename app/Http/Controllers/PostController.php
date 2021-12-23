<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PostCommentRequest;
use App\Models\Post;
use App\Models\Comment;

final class PostController extends Controller
{
    /**
     * Get a single post including comments ordered by the latest
     *
     * @return App\Models\Post
     */
    public function index(): Post
    {
        $post = Post::withCount('comments')->firstOrFail();
        $post->comments = Comment::where('post_id', $post->id)
            ->withDepth()
            ->orderBy('created_at')
            ->get()
            ->toTree();
        return $post;
    }

    /**
     * Validate and insert a single comment
     *
     * @return bool
     */
    public function createComment(PostCommentRequest $request): Comment
    {
        if ($request->filled('parent_id')) {
            $parentComment = Comment::findOrFail($request->parent_id);
            abort_if($parentComment->depth === 3, 422, 'Max depth can be 3');
        }
        return Comment::create($request->validated());
    }
}
