@extends('layouts.main')

@section('title', 'Единицы измерения')
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
                                data-bs-toggle="modal" data-bs-target="#unitAdd">
                                <i class="bx bxs-add-to-queue label-icon"></i> Добавить
                            </button>
                        </div>
                    </div>

                    <x-datatable :datatableButtons="'datatable-buttons'">
                        <thead>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Действия</th>
                        </thead>
                        <tbody>
                            @foreach ($units as $unit)
                                <tr>
                                    <td>{{ $unit->id }}</td>
                                    <td>{{ $unit->name }}</td>
                                    <td>
                                        <a href="{{ route('units.edit', ['unit' => $unit->id]) }}" class="btn btn-info">
                                            <i class="bx bxs-edit-alt"></i>
                                        </a>
                                        <form action="{{ route('units.destroy', $unit->id) }}" method="post"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="bx bx bxs-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-datatable>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <x-modal :modalTitle="'Добавить единицу измерения'" :modalId="'unitAdd'">
        <form action="{{ route('units.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <button type="submit" class="btn btn-success">Добавить</button>
        </form>
    </x-modal>
@endsection
@section('script')
    <script src="/assets/libs/datatables/datatables.min.js"></script>
    <script src="/assets/libs/jszip/jszip.min.js"></script>
    <script src="/assets/js/pages/datatables.init.js"></script>
@endsection
