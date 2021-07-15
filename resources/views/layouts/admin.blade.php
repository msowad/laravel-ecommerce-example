<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.9.55/css/materialdesignicons.min.css" integrity="sha512-vIgFb4o1CL8iMGoIF7cYiEVFrel13k/BkTGvs0hGfVnlbV6XjAA0M0oEHdWqGdAVRTDID3vIZPOHmKdrMAUChA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('admins/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->


    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('admins/css/demo/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admins/css/custom.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ config('app.favicon') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" />

    @yield('extra-css')

    @livewireStyles
    @livewireScripts
</head>

<body>
    <script src="{{ asset('admins/js/preloader.js') }}"></script>
    <div class="body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open">
            <div class="mdc-drawer__header">
                <a href="{{ route('dashboard.home') }}" class="brand-logo">
                    <img class="img-fluid" src="{{ config('app.secondary_logo') }}" alt="logo">
                </a>
            </div>
            <div class="mdc-drawer__content">
                <div class="user-info">
                    <p class="name">{{ auth()->user()->name }}</p>
                    <p class="email">{{ auth()->user()->email }}</p>
                </div>
                <div class="mdc-list-group">
                    <nav class="mdc-list mdc-drawer-menu">
                        <x-nav-link can='view dashboard' icon="dashboard" label="Dashboard" route="dashboard.home" />

                        <x-nav-link can="view order" icon="favorite_border" label="Order" route="dashboard.order" />

                        <x-collapse-nav-link permissions="view product,add product" icon="local_parking" label="Product">
                            <x-nav-link can="view product" label="All" route="dashboard.product" />
                            <x-nav-link can="add product" label="Add" route="dashboard.product.add" />
                        </x-collapse-nav-link>

                        <x-collapse-nav-link permissions="view category,add category" icon="apps" label="Category">
                            <x-nav-link can="view category" label="All" route="dashboard.category" />
                            <x-nav-link can="add category" label="Add" route="dashboard.category.add" />
                        </x-collapse-nav-link>

                        <x-collapse-nav-link permissions="view coupon,add coupon" icon="content_cut" label="Coupon">
                            <x-nav-link can="view coupon" label="All" route="dashboard.coupon" />
                            <x-nav-link can="add coupon" label="Add" route="dashboard.coupon.add" />
                        </x-collapse-nav-link>

                        <x-collapse-nav-link permissions="view size,add size" icon="fullscreen" label="Size">
                            <x-nav-link can="view size" label="All" route="dashboard.size" />
                            <x-nav-link can="add size" label="Add" route="dashboard.size.add" />
                        </x-collapse-nav-link>

                        <x-collapse-nav-link permissions="view brand,add brand" icon="branding_watermark" label="Brand">
                            <x-nav-link can="view brand" label="All" route="dashboard.brand" />
                            <x-nav-link can="add brand" label="Add" route="dashboard.brand.add" />
                        </x-collapse-nav-link>

                        <x-collapse-nav-link permissions="view color,add color" icon="palette" label="Color">
                            <x-nav-link can="view color" label="All" route="dashboard.color" />
                            <x-nav-link can="add color" label="Add" route="dashboard.color.add" />
                        </x-collapse-nav-link>

                        <x-collapse-nav-link permissions="view tax,add tax" icon="attach_money" label="Tax">
                            <x-nav-link can="view tax" label="All" route="dashboard.tax" />
                            <x-nav-link can="add tax" label="Add" route="dashboard.tax.add" />
                        </x-collapse-nav-link>

                        <x-collapse-nav-link permissions="view slider,add slider" icon="view_carousel" label="Slider">
                            <x-nav-link can="view slider" label="All" route="dashboard.slider" />
                            <x-nav-link can="add slider" label="Add" route="dashboard.slider.add" />
                        </x-collapse-nav-link>

                        <x-nav-link can="view user" icon="person_outline" label="User" route="dashboard.user" />
                        <x-nav-link can="view contacts" icon="contact_mail" label="Contacts" route="dashboard.contacts" />
                        <x-nav-link can="manage about us" icon="groups" label="About Us" route="dashboard.aboutUs" />
                        <x-nav-link can="manage my shop" icon="storefront" label="My Shop" route="dashboard.myShop" />

                    </nav>
                </div>
            </div>
        </aside>
        <!-- partial -->
        <div class="main-wrapper mdc-drawer-app-content">
            <!-- partial:partials/_navbar.html -->
            <header class="mdc-top-app-bar">
                <div class="mdc-top-app-bar__row">
                    <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
                        <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button sidebar-toggler">menu</button>
                    </div>
                    <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end mdc-top-app-bar__section-right">
                        <div class="menu-button-container">
                            <button class="mdc-button mdc-menu-button">
                                <i class="mdi mdi-account"></i>
                            </button>
                            <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                                <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
                                    @can('manage my shop')
                                    <a class="d-flex text-dark mdc-list-item" href="{{ route('dashboard.myShop') }}">
                                        <div class="item-thumbnail item-thumbnail-icon-only">
                                            <i class="mdi mdi-alert-circle-outline text-primary"></i>
                                        </div>
                                        <div class="item-content d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="item-subject font-weight-normal">My Shop</h6>
                                        </div>
                                    </a>
                                    @endcan

                                    <a class="d-flex text-dark mdc-list-item" href="{{ route('profile') }}">
                                        <div class="item-thumbnail item-thumbnail-icon-only">
                                            <i class="mdi mdi-account-edit-outline text-primary"></i>
                                        </div>
                                        <div class="item-content d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="item-subject font-weight-normal">Edit profile</h6>
                                        </div>
                                    </a>

                                    <x-admin-logout />

                                </ul>
                            </div>
                        </div>

                        @livewire('admin.dashboard.notifications')

                        @livewire('admin.dashboard.mail-menu')

                    </div>
                </div>
            </header>
            <!-- partial -->
            <div class="page-wrapper mdc-toolbar-fixed-adjust">
                <main class="content-wrapper">
                    {{ $slot }}
                </main>
                <!-- partial:partials/_footer.html -->
                <footer>
                    <div class="mdc-layout-grid">
                        <div class="mdc-layout-grid__inner">
                            <div class="justify-content-center mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop">
                                <span class="text-center text-sm-left d-block d-sm-inline-block tx-14">Copyright © <a href="{{ url('') }}" target="_blank">{{ config('app.name') }}
                                    </a>{{ date('Y') }}</span>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- partial -->
            </div>
        </div>
    </div>


    <script src="{{ asset('admins/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('admins/js/material.js') }}"></script>
    <script src="{{ asset('admins/js/misc.js') }}"></script>

    @yield('extra-js')

    <script src="{{ mix('js/app.js') }}"></script>

</body>

</html>
