@extends('layouts.main')

@section('title', 'Мастер-' . $master->user->first_name . ' ' . $master->user->last_name)

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

                    <x-datatable :datatableButtons="'datatable-buttons'">
                        <thead>
                            <tr>
                                <th class="bg-success text-white">#</th>
                                <th class="bg-success text-white">Название</th>
                                <th class="bg-success text-white">Услуга</th>
                                <th class="bg-success text-white">Сумма</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($master->mastersGroup->ordersServices as $ordersService)
                                <tr>
                                    <td>
                                        {{ $loop->index + 1 }}
                                    </td>
                                    <td>
                                        {{ $ordersService->order->name }}
                                    </td>
                                    <td>
                                        {{ $ordersService->service->name }}
                                    </td>
                                    <td>
                                        {{ (($ordersService->quantity * $ordersService->service->price * $ordersService->width * $ordersService->height) / 100) * $master->procent }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="bg-success text-white">#</th>
                                <th class="bg-success text-white" colspan="2"></th>
                                <th class="bg-success text-white">
                                    {{ number_format($total_sum, 0, ',', ' ') }} СУМ
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
    <script src="/assets/libs/datatables/datatables.min.js"></script>
    <script src="/assets/libs/jszip/jszip.min.js"></script>
    <script src="/assets/js/pages/datatables.init.js"></script>
@endsection
