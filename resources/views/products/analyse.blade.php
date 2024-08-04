@extends('layouts.main')

@section('title', 'Отчеты')
@section('css')
    <link href="/assets/libs/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('filterByData') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3 form-group">
                                    <label for="start_date form-label">От:</label>
                                    <input class="form-control" type="date" id="start_date" name="start_date"
                                        value="{{ $start_date ?? '' }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3 form-group">
                                    <label for="start_date form-label">До:</label>
                                    <input class="form-control" type="date" id="end_date" name="end_date"
                                        value="{{ $end_date ?? '' }}">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <button type="submit" class="btn btn-success">
                                    <i class="bx bx-filter-alt"></i>
                                    ФИЛТР
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <x-datatable :datatableButtons="'datatable-buttons'">
                        <thead>
                            <th>Тип</th>
                            <th>Поставщик</th>
                            <th>Название</th>
                            <th>Дата</th>
                            <th>Цена единици</th>
                            <th>Кол-во</th>
                            <th>Общая цена</th>
                        </thead>
                        <tbody>
                            @foreach ($arrivedProducts as $arrivedProduct)
                                <tr>
                                    <td>
                                        <span
                                            class="badge badge-pill badge-soft-{{ $arrivedProduct->type == 'Списание' ? 'danger' : 'success' }} font-size-11">
                                            {{ $arrivedProduct->type == 'Списание' ? 'Списание' : 'Поступление' }}
                                        </span>

                                    </td>
                                    <td>{{ $arrivedProduct->provider->name }}</td>
                                    <td>{{ $arrivedProduct->product->name }}</td>
                                    <td>{{ $arrivedProduct->product->created_at->format('Y-m-d | H:i') }}</td>
                                    <td>{{ number_format($arrivedProduct->unit_price, 0, ',', ' ') }}</td>
                                    <td>{{ $arrivedProduct->quantity . ' ' . $arrivedProduct->unit->name }}</td>
                                    <td>{{ number_format($arrivedProduct->total_price, 0, ',', ' ') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Итого</th>
                                <th colspan="4"></th>
                                <th>{{ $total_quantity }}</th>
                                <th>
                                    <span class="badge bg-success font-size-16">
                                        {{ number_format($total, 0, ',', ' ') }} сум
                                    </span>
                                </th>
                            </tr>
                        </tfoot>
                    </x-datatable>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <x-datatable :datatableButtons="'datatable-decomission'">
                        <thead>
                            <th>Тип</th>
                            <th>Название</th>
                            <th>Описание</th>
                            <th>Цена единици</th>
                            <th>Кол-во</th>
                            <th>Общая цена</th>
                        </thead>
                        <tbody>
                            @foreach ($decomissionedProducts as $decomissionedProduct)
                                <tr>
                                    <td>
                                        <span
                                            class="badge badge-pill badge-soft-{{ $decomissionedProduct->type == 'Списание' ? 'danger' : 'success' }} font-size-11">
                                            {{ $decomissionedProduct->type == 'Списание' ? 'Списание' : 'Поступление' }}
                                        </span>

                                    </td>
                                    <td>{{ $decomissionedProduct->product->name }}</td>
                                    <td>{{ $decomissionedProduct->product->created_at->format('Y-m-d | H:i') }}</td>
                                    <td>{{ number_format($decomissionedProduct->unit_price, 0, ',', ' ') }}</td>
                                    <td>{{ $decomissionedProduct->quantity . ' ' . $decomissionedProduct->unit->name }}
                                    </td>
                                    <td>{{ number_format($decomissionedProduct->total_price, 0, ',', ' ') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Итого</th>
                                <th colspan="3"></th>
                                <th>{{ $total_decomissioned_quantity }}</th>
                                <th>
                                    <span class="badge bg-success font-size-16">
                                        {{ number_format($total_decomissioned, 0, ',', ' ') }} сум
                                    </span>
                                </th>
                            </tr>
                        </tfoot>
                    </x-datatable>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="/assets/libs/datatables/datatables.min.js"></script>
    <script src="/assets/libs/jszip/jszip.min.js"></script>
    <!-- Datatable init js -->
    <script src="/assets/js/pages/datatables.init.js"></script>
@endsection
