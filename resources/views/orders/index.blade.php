@extends('layouts.main')

@section('title', 'Заказы')

@section('css')
    <link href="/assets/libs/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
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
                                    Заказы
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
                                <th>Статус</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->deadline }}</td>
                                    <td>
                                        @if ($order->status == 'new')
                                            <span class="badge bg-primary font-size-12">{{ $order->status }}</span>
                                        @elseif ($order->status == 'in_progress')
                                            <span class="badge bg-warning font-size-12">{{ $order->status }}</span>
                                        @elseif ($order->status == 'done')
                                            <span class="badge bg-success font-size-12">{{ $order->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        @role('admin|designer')
                                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                                onsubmit="return confirm('Вы уверены, что хотите удалить заказ?');"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        @endrole
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
            <div class="mb-3">
                <label for="name" class="form-label">Клиент</label>
                <select class="form-select" id="client_id" name="client_id">
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->first_name . ' ' . $client->last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="deadline" class="form-label">Дедлайн</label>
                <input type="date" class="form-control" id="deadline" name="deadline">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Статус</label>
                <select class="form-select" name="status">
                    <option value="new">Новый</option>
                    <option value="in_progress">В работе</option>
                    <option value="done">Завершен</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </x-modal>
@endsection
@section('script')
    <script src="/assets/libs/datatables/datatables.min.js"></script>
    <script src="/assets/libs/jszip/jszip.min.js"></script>
    <script src="/assets/js/pages/datatables.init.js"></script>
    <script src="assets/libs/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <script src="assets/js/pages/form-mask.init.js"></script>
@endsection
