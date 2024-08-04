@extends('layouts.main')

@section('title', 'Дизайнеры')


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
                                data-bs-toggle="modal" data-bs-target="#designerAdd">
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
                                <th>
                                    Процент от работы<br>
                                    <small>(в этом месяце)</small>
                                </th>
                                <th>Процент</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($designers as $designer)
                                <tr>
                                    <td>
                                        {{ $designer->user->first_name . ' ' . $designer->user->last_name }}
                                    </td>
                                    <td>{{ $designer->user->phone_number }}</td>
                                    <td>{{ number_format($designer->salary, 0, ',', ' ') }}</td>
                                    <td>
                                        <span class="badge badge-soft-warning font-size-14">
                                            @php
                                                $total_sum = 0;
                                                foreach ($designer->services as $orderService) {
                                                    $total_sum += $orderService->price * $orderService->quantity;
                                                }
                                            @endphp
                                            {{ number_format($total_sum / (100 / $designer->procent), 0, ',', ' ') }}
                                            сум
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary font-size-13">
                                            {{ $designer->procent }}%
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('designers.edit', $designer) }}" class="btn btn-primary">
                                            <i class="bx bxs-edit-alt"></i>
                                        </a>
                                        <form action="{{ route('designers.destroy', $designer) }}" method="post"
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
                    <x-modal :modalId="'designerAdd'">
                        <x-slot name="modalTitle">Добавить дизайнера</x-slot>
                        <form action="{{ route('designers.store') }}" method="POST">
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
