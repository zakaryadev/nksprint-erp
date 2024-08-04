@extends('layouts.main')

@section('title', 'Изменение заказа')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Название</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $order->name }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="desc" class="form-label">Описание</label>
                                    <input type="text" class="form-control" id="desc" name="desc"
                                        value="{{ $order->description }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="deadline" class="form-label">Дедлайн</label>
                                    <input type="date" class="form-control" id="deadline" name="deadline"
                                        value="{{ $order->deadline }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Статус</label>
                                    <select class="form-select" name="status">
                                        <option value="new"
                                            @php
if ($order->status == 'new') {
                                                echo 'selected';
                                            } @endphp>
                                            Новый</option>
                                        <option
                                            value="in_progress"@php
if ($order->status == 'in_progress') {
                                                echo 'selected';
                                            } @endphp>
                                            В процессе</option>
                                        <option
                                            value="done"@php
if ($order->status == 'done') {
                                                echo 'selected';
                                            } @endphp>
                                            Завершен</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save font-size-14"></i>
                            Сохранить
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
