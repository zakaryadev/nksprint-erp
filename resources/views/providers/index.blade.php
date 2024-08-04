@extends('layouts.main')

@section('title', 'Поставщики')

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
                                data-bs-toggle="modal" data-bs-target="#addProvider">
                                <i class="bx bxs-add-to-queue label-icon"></i> Добавить
                            </button>
                        </div>
                    </div>
                    <x-datatable :datatableButtons="'datatable-buttons'">
                        <thead>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Телефон</th>
                            <th>Действия</th>
                        </thead>
                        <tbody>
                            @foreach ($providers as $provider)
                                <tr>
                                    <td>{{ $provider->id }}</td>
                                    <td>{{ $provider->name }}</td>
                                    <td>{{ $provider->phone_number }}</td>
                                    <td>
                                        <a href="{{ route('providers.edit', $provider->id) }}" class="btn btn-primary">
                                            <i class="bx bxs-edit-alt"></i>
                                        </a>
                                        <form action="{{ route('providers.destroy', $provider->id) }}" method="POST"
                                            style="display: inline-block">
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
    <x-modal :modalId="'addProvider'" :modalTitle="'Добавить поставщика'">
        <form action="{{ route('providers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Телефон</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number">
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
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
