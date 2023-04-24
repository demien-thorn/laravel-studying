@extends('layouts.master')

<?php /** @var App\Models\Comment $comments */ ?>

@section('title', __('title.comments'))

@section('content')
    <h3>@lang('titles.comments')</h3>

    <div class="chat-window" id="comment_field">
        @isset($comments)
            @foreach($comments as $comment)
                <div class="chat-comment" id="comments-{{ $comment->id }}">
                    <div>
                        <span class="chat-name" id="{{ $comment->username.'-'.$comment->id }}">
                            - {{ $comment->username }}
                        </span>
                        <span class="chat-time">
                            @lang('main.others.at') {{ $comment->created_at }}
                        </span>
                        <br>
                        <span class="chat-email" id="{{ $comment->email.'-'.$comment->id }}">
                            - {{ $comment->email }}
                        </span>
                        <br>
                        <span class="chat-message" id="{{ $comment->comment.'-'.$comment->id }}">
                            {{ $comment->comment }}
                        </span>
                    </div>
                    <form class="button-delete" method="post">
                        @csrf
                        <input type="hidden" name="hiddenId" value="{{ $comment->id }}">
                        <input type="hidden" name="hiddenUsername" value="{{ $comment->username }}">
                        <input type="hidden" name="hiddenEmail" value="{{ $comment->email }}">
                        <input type="hidden" name="hiddenComment" value="{{ $comment->comment }}">

                        <button type="button" id="edit-{{ $comment->id }}" class="btn btn-primary fw-bold edit-comment"
                            data-url="{{ url('/api/comments/edit') }}">
                            @lang('buttons.edit')
                        </button>

                        <button type="button" class="btn btn-primary fw-bold delete-comment"
                            data-url="{{ url('/api/comments/delete') }}">
                            @lang('buttons.delete')
                        </button>
                    </form>
                </div>
            @endforeach
        @endisset
    </div>
    {{ $comments->links('pagination::bootstrap-5') }}

    <form method="post" class="form-container" id="comment-form">
        @csrf
        <label for="username">@lang('form.user_name'):</label>
        @include('layouts.error', ['fieldName' => 'username'])
        <input type="text" name="username" id="username" style="display: block">

        <label for="email">@lang('form.email'):</label>
        @include('layouts.error', ['fieldName' => 'email'])
        <input type="email" name="email" id="email" style="display: block">

        <label for="password">@lang('form.password'):</label>
        @include('layouts.error', ['fieldName' => 'password'])
        <input type="password" name="password" id="password" style="display: block">

        <label for="comment">@lang('form.comment'):</label>
        @include('layouts.error', ['fieldName' => 'comment'])
        <textarea name="comment" id="comment" cols="30" rows="10" style="display: block"></textarea>

        <input type="submit" value="@lang('buttons.send')" id="comment-send" style="display: block"
            class="btn btn-primary btn-lg px-4 fw-bold">
    </form>
@endsection
