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
                Your name: <input type="text" name="name" placeholder="Name">
                Your phone: <input type="text" name="phone" placeholder="Phone">
                @csrf
                <input type="submit" value="Order confirmed!">
            </form>
        </div>
    </div>
@endsection
