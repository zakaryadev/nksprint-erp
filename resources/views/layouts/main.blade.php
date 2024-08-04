<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>NukusPrintCRM-@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    @yield('css')
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">
    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body data-sidebar="dark">
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="{{ route('dashboard') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="/assets/images/logo-mark.svg" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="/assets/images/logo-horizontal-dark.svg" alt="" height="32">
                            </span>
                        </a>

                        <a href="{{ route('dashboard') }}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="/assets/images/logo-mark.svg" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="/assets/images/logo-horizontal-dark.svg" alt="" height="32">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-18 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="bx bx-menu"></i>
                    </button>

                    {{-- <!-- App Search-->
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="bx bx-search-alt"></span>
                        </div>
                    </form> --}}
                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..."
                                            aria-label="Recipient's username">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                            <i class="bx bx-fullscreen"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user"
                                src="https://ui-avatars.com/api/?background=random&color=fff&bold=true&size=128&name={{ auth()->user()->first_name . '+' . auth()->user()->last_name }}"
                                alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1"
                                key="t-henry">{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="bx bx-user font-size-16 align-middle me-1"></i>
                                <span>Профиль</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <div class="row">
                                <div class="d-flex justify-content-center">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger text-white">
                                            <i class="bx bx-power-off font-size-16 align-middle me-1"></i>
                                            <span>Выйти</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                            <i class="bx bx-cog bx-spin"></i>
                        </button>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Меню</li>
                        @role('admin|designer|master')
                            <li>
                                <a href="{{ route('dashboard') }}" class="waves-effect">
                                    <i class="bx bx-home-circle"></i>
                                    <span>Главное</span>
                                </a>
                            </li>
                        @endrole
                        @role('admin|designer')
                            <li>
                                <a href="{{ route('clients.index') }}" class="waves-effect">
                                    <i class="bx bx-group"></i>
                                    <span>Клиенты</span>
                                </a>
                            </li>
                        @endrole
                        <li>
                            <a href="{{ route('orders.index') }}" class="waves-effect">
                                <i class="bx bx-note"></i>
                                <span>Заказы</span>
                            </a>
                        </li>
                        @role('admin')
                            <li>
                                <a href="{{ route('services.index') }}" class="waves-effect">
                                    <i class="bx bx-list-ul"></i>
                                    <span>Услуги</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-building-house"></i>
                                    <span>Персонал</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <a href="{{ route('master-groups.index') }}" class="waves-effect">
                                            <i class="bx bx-folder"></i>
                                            <span>Мастер-группы</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('masters.index') }}" class="waves-effect">
                                            <i class="bx bxs-wrench"></i>
                                            <span>Мастеры</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('designers.index') }}" class="waves-effect">
                                            <i class="bx bx-brush"></i>
                                            <span>Дизайнеры</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-archive"></i>
                                    <span>Склад</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <a href="{{ route('units.index') }}">
                                            <i class="bx bx-ruler"></i> Ед-измер
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('products.index') }}">
                                            <i class="bx bx-box"></i> Товары
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('arrivedProducts') }}">
                                            <i class="bx bx-analyse"></i> Отчеты
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('providers.index') }}">
                                            <i class="bx bxs-truck"></i>
                                            Поставщики
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endrole

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">@yield('title')</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    @yield('content')

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © 🔥 <a href="https://t.me/zakdsgn">
                                ZakDev</a>.
                        </div>

                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title d-flex align-items-center px-3 py-4">

                <h5 class="m-0 me-2">Settings</h5>

                <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
            </div>

            <!-- Settings -->
            <hr class="mt-0" />
            <h6 class="text-center mb-0">Choose Layouts</h6>

            <div class="p-4">
                <div class="mb-2">
                    <img src="/assets/images/layouts/layout-1.jpg" class="img-thumbnail" alt="layout images">
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                    <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                </div>

                <div class="mb-2">
                    <img src="/assets/images/layouts/layout-2.jpg" class="img-thumbnail" alt="layout images">
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch">
                    <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                </div>

                <div class="mb-2">
                    <img src="/assets/images/layouts/layout-3.jpg" class="img-thumbnail" alt="layout images">
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch">
                    <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                </div>

                <div class="mb-2">
                    <img src="/assets/images/layouts/layout-4.jpg" class="img-thumbnail" alt="layout images">
                </div>
                <div class="form-check form-switch mb-5">
                    <input class="form-check-input theme-choice" type="checkbox" id="dark-rtl-mode-switch">
                    <label class="form-check-label" for="dark-rtl-mode-switch">Dark RTL Mode</label>
                </div>


            </div>

        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="/assets/libs/jquery/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/libs/node-waves/waves.min.js"></script>

    <script src="/assets/js/app.js"></script>
    @yield('script')
</body>

</html>
