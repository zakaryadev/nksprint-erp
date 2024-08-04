@extends('layouts.main')

@section('title', 'Инофрмация о клиенте')

@section('css')
    <link href="/assets/libs/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                        <thead class="bg-info card-header bg-transparent border-bottom text-uppercase">
                            <th scope="row">ФИО</th>
                            <th scope="row">Телефон</th>
                            <th scope="row">Организация</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $client->first_name . ' ' . $client->last_name }}</td>
                                <td>{{ $client->phone_number }}</td>
                                <td>{{ $client->company_name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="d-flex justify-content-between">
                            <div class="div">
                                <p class="card-title">
                                    Заказы клиента
                                </p>
                            </div>
                            <button type="button" class="mb-3 btn btn-success waves-effect btn-label waves-light"
                                data-bs-toggle="modal" data-bs-target="#orderAdd">
                                <i class="bx bxs-add-to-queue label-icon"></i> Добавить
                            </button>
                        </div>
                    </div>
                    <x-datatable :datatableButtons="'datatable-buttons'">
                        <thead>
                            <tr>
                                <th>Название</th>
                                <th>Дата</th>
                                <th>Дедлайн</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($client->orders as $order)
                                <tr>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->created_at->format('Y-m-d | H:s') }}</td>
                                    <td>{{ $order->deadline }}</td>
                                    <td>
                                        <a href="{{ route('orders.show', $order) }}" class="btn btn-warning">
                                            <i class="bx bxs-show"></i>
                                        </a>
                                        <a href="{{ route('orders.edit', $order) }}" class="btn btn-primary">
                                            <i class="bx bxs-edit-alt"></i>
                                        </a>
                                        <form action="{{ route('orders.destroy', $order) }}" method="post"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="bx bxs-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-datatable>
                </div>
            </div>
        </div>
    </div>
    <x-modal :modalId="'orderAdd'">
        <x-slot name="modalTitle">Добавить заказ</x-slot>
        <form action="{{ route('orders.store') }}" method="post">
            @csrf
            <input type="hidden" name="client_id" value="{{ $client->id }}">
            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Описание</label>
                <input type="text" class="form-control" id="desc" name="desc">
            </div>
            <div class="mb-3">
                <label for="deadline" class="form-label">Дедлайн</label>
                <input type="date" class="form-control" id="deadline" name="deadline">
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </x-modal>
@endsection

@section('script')
    <script src="/assets/libs/datatables/datatables.min.js"></script>
    <script src="/assets/libs/jszip/jszip.min.js"></script>
    <script src="/assets/js/pages/datatables.init.js"></script>

    <script src="/assets/js/app.js"></script>
@endsection
