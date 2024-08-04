@extends('layouts.main')

@section('title', 'Мастеры')


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
                                data-bs-toggle="modal" data-bs-target="#masterAdd">
                                <i class="bx bxs-add-to-queue label-icon"></i> Добавить
                            </button>
                        </div>
                    </div>
                    <x-datatable :datatableButtons="'datatable-buttons'">
                        <thead>
                            <tr>
                                <th>ФИО</th>
                                <th>Телефон</th>
                                <th>Оклад</th>
                                <th>Процент</th>
                                <th>Группа</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($masters as $master)
                                <tr>
                                    <td>{{ $master->user->first_name . ' ' . $master->user->last_name }}</td>
                                    <td>{{ $master->user->phone_number }}</td>
                                    <td>{{ number_format($master->salary, 0, ',', ' ') }}</td>
                                    <td>
                                        <span class="badge bg-primary font-size-13">
                                            {{ $master->procent }}%
                                        </span>
                                    </td>
                                    <td>{{ $master->mastersGroup->name }}</td>
                                    <td>
                                        <a href="{{ route('masters.show', $master) }}" class="btn btn-info">
                                            <i class="bx bxs-show"></i>
                                        </a>
                                        <a href="{{ route('masters.edit', $master) }}" class="btn btn-primary">
                                            <i class="bx bxs-edit-alt"></i>
                                        </a>
                                        <form action="{{ route('masters.destroy', $master) }}" method="post"
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
                    <x-modal :modalId="'masterAdd'">
                        <x-slot name="modalTitle">Добавить мастера</x-slot>
                        <form action="{{ route('masters.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Фамилия</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">Имя</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-4">
                                        <label for="input-mask">Телефон</label>
                                        <input id="input-mask" class="form-control input-mask"
                                            data-inputmask="'mask': '+8999999999'" im-insert="true" name="phone_number">
                                        <span class="text-muted">e.g "+8 91 382 84 33"</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Э-мейл</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Парол</label>
                                        <input type="text" class="form-control" id="password" name="password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="salary" class="form-label">Оклад</label>
                                        <input type="text" class="form-control" id="salary" name="salary" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="procent" class="form-label">Процент</label>
                                        <input type="text" class="form-control" id="procent" name="procent" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="masters_group" class="form-label">Группа мастеров</label>
                                        <select class="form-select" id="masters_group" name="masters_group_id">
                                            <option value="">
                                                Выберите группы
                                            </option>
                                            @foreach ($masterGroups as $masterGroup)
                                                <option value="{{ $masterGroup->id }}">{{ $masterGroup->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit1" class="btn btn-primary">Добавить</button>
                        </form>
                    </x-modal>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="/assets/libs/datatables/datatables.min.js"></script>
    <script src="/assets/libs/jszip/jszip.min.js"></script>
    <script src="/assets/js/pages/datatables.init.js"></script>
    <script src="assets/libs/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <script src="assets/js/pages/form-mask.init.js"></script>
@endsection
