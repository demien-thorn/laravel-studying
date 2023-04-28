<?php

namespace App\Http\Resources\Comments;

use App\Http\Requests\Comments\CommentRequest;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  CommentRequest  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'comment' => $this->comment,
            'created_at' => $this->created_at,
        ];
    }
}
