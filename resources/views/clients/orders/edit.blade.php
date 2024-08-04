@extends('layouts.main')

@section('title', 'Редактирование заказа')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('orders.update', ['order' => $order->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="client_id" value="{{ $order->client_id }}">
                        <div class="mb-3">
                            <label for="name" class="form-label">Название</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $order->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Описание</label>
                            <textarea class="form-control" id="desc" name="desc">{{ $order->desc }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Дедлайн</label>
                            <input type="date" class="form-control" id="deadline" name="deadline"
                                value="{{ $order->deadline }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
