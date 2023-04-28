<?php

namespace App\Services\Comments;

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
}
