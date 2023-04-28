<?php

namespace App\Services\Comments;

use App\Http\Requests\Comments\CommentRequest;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CommentsService
{
    /**
     * @return string
     */
    public static function randomString(): string
    {
        return substr(string: str_shuffle(string: config(key: 'salt.salt')), offset: 0, length: 10);
    }

    /**
     * @param $comment
     * @return string
     */
    public static function hashForComment($comment): string
    {
        return md5(string: $comment.config(key: 'salt.salt'));
    }

    /**
     * @param $comment
     * @return string
     */
    public static function moderationStatus($comment): string
    {
        if (str_contains($comment, '@')) {
            return 'on_moderation';
        } else {
            return 'confirmed';
        }
    }

    /**
     * @return mixed
     */
    public static function showComments(): mixed
    {
        return Comment::orderBy('created_at', 'asc')->paginate(perPage: 20);
    }

    /**
     * @param $request
     * @return int
     */
    public static function createComment($request): int
    {
        return DB::table(table: 'comments')->insertGetId(values: [
            'username' => $request->username,
            'password' => $request->password,
            'email' => $request->email,
            'comment' => $request->comment,
            'rand_string' => CommentsService::randomString(),
            'moderation_status' => CommentsService::moderationStatus(comment: $request->comment),
            'hash' => CommentsService::hashForComment(comment: $request->comment),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    /**
     * @param $request
     * @param $comment
     * @return mixed
     */
    public static function updateComment($request, $comment): mixed
    {
        $comment->moderation_status = CommentsService::moderationStatus(comment: $request->comment);
        return $comment->update(attributes: $request->all());
    }

    /**
     * @param $comment
     * @return void
     */
    public static function deleteComment($comment): void
    {
        $comment->delete();
    }
}
