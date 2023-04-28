@extends('layouts.master')

<?php /** @var App\Models\Comment $comments */ ?>

@section('title', __('title.comments'))

@section('content')
    <h3>@lang('titles.comments')</h3>

    <div class="chat-window" id="comment_field">
    </div>

    @isset($comments)
        {{ $comments->links('pagination::bootstrap-5') }}
    @endisset

    <form class="form-container" id="comment-form">
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
        @include('layouts.error', ['fieldName' => 'comments.comment'])
        <textarea name="comment" id="comment" cols="30" rows="10" style="display: block"></textarea>

        <button type="button" class="btn btn-primary btn-lg px-4 fw-bold" id="comment-send">
            @lang('buttons.send')
        </button>
    </form>
@endsection
