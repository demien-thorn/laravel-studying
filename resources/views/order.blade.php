@extends('layouts.master', ['file' => 'order'])

@section('title', 'Checkout')

@section('content')
    <h3>Place your order</h3>

    <div class="content-main clearfix">
        <div class="form-container">
            <div class="small-text">
                Total cost of the order: <b>{{ $order->calculateFullSum() }} UAH</b><br>
                Note your name and phone in the form below for our manager could connect you
            </div>
            <form action="{{route(name: 'basket-confirm')}}" method="post">
                @csrf
                <label for="name">Your name:</label>
                <input type="text" name="name" id="name" placeholder="Name">
                <label for="phone">Your phone:</label>
                <input type="text" name="phone" id="phone" placeholder="Phone">
                @guest
                    <label for="email">Your e-mail:</label>
                    <input type="email" name="email" id="email" placeholder="E-mail">
                @endguest
                <input type="submit" value="Order confirmed!">
            </form>
        </div>
    </div>
@endsection
