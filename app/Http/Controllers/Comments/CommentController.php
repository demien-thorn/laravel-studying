<?php

namespace App\Http\Controllers\Comments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comments\CommentRequest;
use App\Models\Comment;
use App\Services\Comments\CommentsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a view of the resource.
     *
     * @return Application|Factory|View
     */
    public function view(): View|Factory|Application
    {
        $comments = Comment::paginate(perPage: 20);
        return view(view: 'comments/comment', data: compact(var_name: 'comments'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $comments = Comment::orderBy('created_at', 'asc')->paginate(perPage: 20);
        return response()->json(data: $comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $request
     * @return string|false
     */
    public function store(CommentRequest $request): bool|string
    {
        $commentId = DB::table(table: 'comments')->insertGetId(values: [
            'username' => $request->all()['username'],
            'password' => $request->all()['password'],
            'email' => $request->all()['email'],
            'comment' => $request->all()['comment'],
            'rand_string' => CommentsService::randomString(),
            'moderation_status' => CommentsService::moderationStatus(comment: $request->all()['comment']),
            'hash' => CommentsService::hashForComment(comment: $request->all()['comment']),
        ]);
        return json_decode(json: $commentId);
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
        $comment->moderation_status = CommentsService::moderationStatus(comment: $request->all()['comment']);

        $comment->update(attributes: $request->all());
        return response()->json(data: ['message' => 'Comment updated successfully']);
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
        return response()->json(data: ['message' => 'Comment deleted successfully']);
    }
}
