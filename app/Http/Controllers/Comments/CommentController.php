<?php

namespace App\Http\Controllers\Comments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comments\CommentRequest;
use App\Http\Resources\Comments\CommentResource;
use App\Models\Comment;
use App\Services\Comments\CommentsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return CommentResource::collection(resource: CommentsService::showComments());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $request
     * @return JsonResponse
     */
    public function store(CommentRequest $request): JsonResponse
    {
        return response()->json(data: ['commentId' => CommentsService::createComment(request: $request)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CommentRequest $request
     * @param Comment $comment
     * @return CommentResource
     */
    public function update(CommentRequest $request, Comment $comment): CommentResource
    {
        CommentsService::updateComment(request: $request, comment: $comment);
        return new CommentResource(resource: $comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return CommentResource
     */
    public function destroy(Comment $comment): CommentResource
    {
        CommentsService::deleteComment(comment: $comment);
        return new CommentResource(resource: $comment);
    }
}
