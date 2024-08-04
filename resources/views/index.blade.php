@extends('layouts.main')
@section('title', 'Главная')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                @role('admin')
                    <a href="{{ route('products.index') }}" class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body waves-effect">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium">Товары в складе на сумму</p>
                                        <h4 class="mb-0">{{ $products_sum }} сум</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                            <span class="avatar-title">
                                                <i class="bx bx-archive font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('services.index') }}" class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body waves-effect">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium">Услуги</p>
                                        <h4 class="mb-0">{{ $services_count }}</h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bxs-wrench font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('orders.index') }}" class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body waves-effect">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium">Работы в процессе</p>
                                        <h4 class="mb-0">{{ $orders_in_progress }}</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endrole
                @role('designer')
                    <a href="{{ route('orders.index') }}" class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body waves-effect">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium">Работы в процессе</p>
                                        <h4 class="mb-0">{{ $orders_in_progress }}</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body waves-effect">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium">Мои работы</p>
                                        <h4 class="mb-0">
                                            @php
                                                $total_sum = 0;
                                                foreach ($designer->services as $orderService) {
                                                    $total_sum += $orderService->price * $orderService->quantity;
                                                }
                                            @endphp
                                            {{ number_format($total_sum / (100 / $designer->procent), 0, ',', ' ') }}
                                            сум
                                        </h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body waves-effect">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium">Оклад</p>
                                        <h4 class="mb-0">
                                            {{ number_format($designer->salary, 0, ',', ' ') }} сум
                                        </h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endrole
                <!-- end row -->
            </div>
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card overflow-hidden waves-effect">
                            <div class="bg-primary bg-soft">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-3">
                                            <h5 class="text-primary">Добро Пожаловать !</h5>
                                            <ul>
                                                <li>
                                                    {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @role('admin')
                        <div class="col-md-8">
                            <div class="row">
                                <a href="{{ route('masters.index') }}" class="col-md-4">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body waves-effect">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <p class="text-muted fw-medium">Мастеры</p>
                                                    <h4 class="mb-0">{{ $masters_count }}</h4>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center">
                                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                        <span class="avatar-title rounded-circle bg-primary">
                                                            <i class="bx bxs-wrench font-size-24"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ route('master-groups.index') }}" class="col-md-4">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body waves-effect">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <p class="text-muted fw-medium">Мастер-группы</p>
                                                    <h4 class="mb-0">{{ $master_groups_count }}</h4>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center">
                                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                        <span class="avatar-title rounded-circle bg-primary">
                                                            <i class="bx bx-folder font-size-24"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ route('designers.index') }}" class="col-md-4">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body waves-effect">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <p class="text-muted fw-medium">Дизайнеры</p>
                                                    <h4 class="mb-0">{{ $designers_count }}</h4>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center">
                                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                        <span class="avatar-title rounded-circle bg-primary">
                                                            <i class="bx bx-brush font-size-24"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endrole
                </div>
            </div>
        @endsection
