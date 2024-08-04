@extends('layouts.main')

@section('title', 'Склад')
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
                            <div class="div"></div>
                            <button type="button" class="mb-3 btn btn-success waves-effect btn-label waves-light"
                                data-bs-toggle="modal" data-bs-target="#addProduct">
                                <i class="bx bxs-add-to-queue label-icon"></i> Добавить
                            </button>
                        </div>
                    </div>
                    <x-datatable :datatableButtons="'datatable-buttons'">
                        <thead>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Описание</th>
                            <th>Ед-измер</th>
                            <th>Цена единици</th>
                            <th>Кол-во</th>
                            <th>Действия</th>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->desc }}</td>
                                    <td>{{ $product->unit->name }}</td>
                                    <td>{{ $product->unit_price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">
                                            <i class="bx bxs-edit-alt"></i>
                                        </a>
                                        <a href="{{ route('products.arrive', $product->id) }}"
                                            class="btn btn-success bg-success bg-gradient">
                                            <i class="bx bxs-add-to-queue"></i>
                                        </a>
                                        <a href="{{ route('products.decomission', $product->id) }}" class="btn btn-danger">
                                            <i class="bx bxs-minus-square"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-datatable>
                </div>
            </div>
        </div>
    </div>
    <x-modal :modalId="'addProduct'" :modalTitle="'Добавить товара'">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Описание</label>
                <input type="text" class="form-control" id="desc" name="desc">
            </div>
            <div class="mb-3">
                <label for="unit" class="form-label">Ед-измер</label>
                <select class="form-select" id="unit" name="unit_id">
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="unit_price" class="form-label">Цена единици</label>
                <input type="text" class="form-control" id="unit_price" name="unit_price">
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Кол-во</label>
                <input type="text" class="form-control" id="quantity" name="quantity">
            </div>

            <button type="submit" class="btn btn-success">Добавить</button>
        </form>
    </x-modal>
@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="/assets/libs/datatables/datatables.min.js"></script>
    <script src="/assets/libs/jszip/jszip.min.js"></script>
    <!-- Datatable init js -->
    <script src="/assets/js/pages/datatables.init.js"></script>
@endsection
