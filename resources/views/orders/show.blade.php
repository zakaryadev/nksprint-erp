@extends('layouts.main')

@section('title', 'Заказ №' . $order->id)

@section('content')
    <h1>Заказ №{{ $order->id }}</h1>
    <p>Создан: {{ $order->created_at }}</p>
    <p>Статус: {{ $order->status }}</p>
    <p>Сумма: {{ $order->total }} руб.</p>
    <h2>Товары в заказе</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Наименование</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Сумма</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }} руб.</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ $product->pivot->quantity * $product->price }} руб.</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
