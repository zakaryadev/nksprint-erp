@extends('layouts.main')

@section('title', 'Заказ - ' . $order->name)

@section('css')
    <link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                        <thead class="bg-info card-header bg-transparent border-bottom text-uppercase">
                            <th scope="row">Название</th>
                            <th scope="row">Описание</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->desc }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @role('admin|designer')
                        <div class="row mt-4">
                            <div class="col-12">
                                <form action="{{ route('orders.storeServices', $order) }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="service_id" class="form-label">Услуга</label>
                                                <select onchange="getService(this)" class="form-control form-select services"
                                                    name="service_id">
                                                    <option value="">Выберите услугу</option>
                                                    @foreach ($services as $service)
                                                        <option id="{{ $service->id }}" value="{{ $service->id }}">
                                                            {{ $service->name . '–' . $service->unit->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="service_id" class="form-label">Исполнитель</label>
                                                <select class="form-control form-select services" name="orderable">
                                                    <option value="">Выберите услугу</option>
                                                    @foreach ($masters_groups as $masters_group)
                                                        <option id="{{ $masters_group->id }}" value="{{ $masters_group }}">
                                                            {{ $masters_group->name }}
                                                        </option>
                                                    @endforeach
                                                    @foreach ($designers as $designer)
                                                        <option id="{{ $designer->id }}" value="{{ $designer }}">
                                                            {{ $designer->user->first_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                {{-- <input type="hidden" name="orderable_type" value="App\Models\MasterGroup"> --}}
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="price" class="form-label">Цена</label>
                                                <input type="number" class="form-control" id="price" name="price"
                                                    required onchange="total()" value="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="mb-3">
                                                <label for="date" class="form-label">Ширина</label>
                                                <input type="text" class="form-control" id="width" name="width"
                                                    required value="1" onchange="total()">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="mb-3">
                                                <label for="height" class="form-label">Высота</label>
                                                <input type="text" class="form-control" id="height" name="height"
                                                    required value="1" onchange="total()">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="mb-3">
                                                <label for="quantity" class="form-label">Количество</label>
                                                <input type="number" class="form-control" id="quantity" name="quantity"
                                                    required value="1" onchange="total()">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="mb-3">
                                                <label for="total_price" class="form-label">Итоговая сумма</label>
                                                <div>
                                                    <p id="totalPrice">Сумма:</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <button type="button" class="btn btn-success" onclick="total()">
                                            <i class="bx bx-calculator label-icon"></i>
                                            Считать
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bx bx-plus label-icon"></i>
                                            Добавить
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endrole
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Услуги</h4>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <table class="table table-bordered table-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>Название</th>
                                <td>Описание</td>
                                <th>Соотрудник</th>
                                <th>Сумма</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->services as $service)
                                @php
                                    $total_price =
                                        $service->pivot->price *
                                        $service->pivot->quantity *
                                        $service->pivot->height *
                                        $service->pivot->width;

                                @endphp
                                <tr>
                                    <td>
                                        <p>{{ $service->name }}</p>
                                        <div>
                                            <span class="badge bg-primary font-size-14">
                                                {{ $service->pivot->width . 'x' . $service->pivot->height }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        штук: <b>{{ $service->pivot->quantity }}</b><br>
                                        высота: <b>{{ $service->pivot->height }}</b><br>
                                        ширина: <b>{{ $service->pivot->width }}</b><br>
                                        количество: <b>{{ $service->pivot->quantity }}</b>
                                    </td>
                                    <td>
                                        @if ($service->pivot->orderable->user)
                                            <p>{{ $service->pivot->orderable->user->first_name }}</p>
                                            <span class="badge badge-soft-warning font-size-14">
                                                {{ $total_price / (100 / $service->pivot->orderable->procent) }} сум
                                            </span>
                                        @else
                                            <p>{{ $service->pivot->orderable->name }}</p>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $total_price }}
                                    </td>
                                    @role('admin|designer')
                                        <td>
                                            <form action="{{ route('orders.destroyService', [$order]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" value="{{ $service->pivot->id }}" name="pivot_id" />
                                                <button type="submit" class="btn btn-danger waves-effect waves-light">
                                                    <i class="bx bxs-trash label-icon"></i>
                                                </button>
                                            </form>
                                        </td>
                                    @endrole
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/assets/libs/jquery/jquery.min.js"></script>
    <script src="/assets/libs/select2/js/select2.min.js"></script>
    <!-- form advanced init -->
    <script>
        function total() {
            var price = $('#price').val();
            var quantity = $('#quantity').val();
            var width = $('#width').val();
            var height = $('#height').val();
            var totalPrice = price * quantity * width * height;
            var formatted = new Intl.NumberFormat('ru-RU').format(totalPrice);
            console.log(price, quantity, width, height);
            $('#totalPrice').html("Сумма:" + " " + formatted + " " + "сум");
        }

        function getService(e) {
            var selected = e.options[e.selectedIndex];
            var id = selected.id;
            if (e.value) {
                $.ajax({
                    url: '/services/' + e.value,
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('#price').val(data.price);
                    }
                });
            }
        }
    </script>
@endsection
