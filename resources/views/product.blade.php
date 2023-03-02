@extends('layouts.master', ['file' => 'product'])

@section('title', 'Товар')

@section('content')
<h3>iPhone X</h3>
<div class="undertitle">{{$product}}</div>

<div class="content-main clearfix">
    <div class="content-section">
        <h4><a href="#">iPhone</a></h4>
        <div class="content-txt">Первый смартфон Apple без кнопок</div>
        <button class="button_extra_small"><a href="{{route(name: 'basket')}}">В корзину</a></button>
        <button class="button_extra_small"><a href="#">Подробнее</a></button>
    </div>
</div>
@endsection
