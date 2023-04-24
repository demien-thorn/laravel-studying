<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $comments = Comment::orderBy('created_at', 'desc')->paginate(perPage: 10);
        return view(view: 'comment', data: compact(var_name: 'comments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $request
     * @return string|false
     */
    public function store(CommentRequest $request): bool|string
    {
        $comment = Comment::create($request->all());
        return json_encode(['comment' => $comment->comment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Comment $comment
     * @return void
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CommentRequest $request
     * @param Comment $comment
     * @return JsonResponse
     */
    public function update(CommentRequest $request, Comment $comment): JsonResponse
    {
        $comment->update(attributes: $request->all());
        return response()->json(['message' => 'Comment updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return JsonResponse
     */
    public function destroy(Comment $comment): JsonResponse
    {
        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
