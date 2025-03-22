@php
$timestamp = time();
$dt = new DateTime('now');
$dt->setTimestamp($timestamp);
$hour = $dt->format('H');
$name = $admin['adm_firstname'];
if ($hour >= 20) {
    $greeting = 'Good Night ' . $name . '  , Have a good night rest.';
} elseif ($hour > 17) {
    $greeting = 'Good Evening ' . $name . ' , Hope you enjoyed your day?';
} elseif ($hour > 11) {
    $greeting = 'Good Afternoon ' . $name . ' , How is your day going?';
} elseif ($hour < 12) {
    $greeting = 'Good Morning ' . $name . ' , How was your night?';
}
@endphp
<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="/dashboard/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - True Talk Arena</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/dashboard/assets/vendor/fonts/boxicons.css?v={{ env('APP_VERSION') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/dashboard/assets/vendor/css/core.css?v={{ env('APP_VERSION') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="/dashboard/assets/vendor/css/theme-default.css?v={{ env('APP_VERSION') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/dashboard/assets/css/demo.css?v={{ env('APP_VERSION') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css?v={{ env('APP_VERSION') }}" />

    <link rel="stylesheet"
        href="/dashboard/assets/vendor/libs/apex-charts/apex-charts.css?v={{ env('APP_VERSION') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="/dashboard/assets/vendor/js/helpers.js?v={{ env('APP_VERSION') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js?v={{ env('APP_VERSION') }} in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/dashboard/assets/js/config.js?v={{ env('APP_VERSION') }}"></script>
</head>

<body>
    @include('layouts.preloader')
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('dashboard.layouts.aside')

            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('dashboard.layouts.nav')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-lg-8 mb-4 order-0">
                                <div class="card">
                                    <div class="d-flex align-items-end row">
                                        <div class="col-sm-7">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary">Hi {{ $name }}! 🎉</h5>
                                                <p class="mb-4" id="greeting">
                                                    {{ $greeting }}
                                                </p>

                                                {{-- <a href="javascript:;" class="btn btn-sm btn-outline-primary">View
                                                    Badges</a> --}}
                                            </div>
                                        </div>
                                        <div class="col-sm-5 text-center text-sm-left">
                                            <div class="card-body pb-0 px-0 px-md-4">
                                                <img src="/dashboard/assets/img/illustrations/man-with-laptop-light.png"
                                                    height="140" alt="View Badge User"
                                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->


                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js?v={{ env('APP_VERSION') }} -->
    <script src="/dashboard/assets/vendor/libs/jquery/jquery.js?v={{ env('APP_VERSION') }}"></script>
    <script src="/dashboard/assets/vendor/libs/popper/popper.js?v={{ env('APP_VERSION') }}"></script>
    <script src="/dashboard/assets/vendor/js/bootstrap.js?v={{ env('APP_VERSION') }}"></script>
    <script src="/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js?v={{ env('APP_VERSION') }}"></script>

    <script src="/dashboard/assets/vendor/js/menu.js?v={{ env('APP_VERSION') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="/dashboard/assets/vendor/libs/apex-charts/apexcharts.js?v={{ env('APP_VERSION') }}"></script>

    <!-- Main JS -->
    <script src="/dashboard/assets/js/main.js?v={{ env('APP_VERSION') }}"></script>
    <script>
        var stage = 0;
        const greeting = () => {
            var date = new Date();
            var nowTime = new Date();
            const hour = nowTime.getHours();
            console.log(nowTime);
            if (hour >= 20) {
                var val = `Good Night {{ $admin['adm_firstname'] }}  , Have a good night rest.`;
                if (stage !== 1) {
                    $('#greeting').html(val)
                    stage = 1
                }
            } else if (hour > 17) {
                var val = `Good Evening {{ $admin['adm_firstname'] }} , Hope you enjoyed your day?`;
                if (stage !== 2) {
                    $('#greeting').html(val)
                    stage = 2
                }
            } else if (hour > 11) {
                var val = `Good Afternoon {{ $admin['adm_firstname'] }} , How is your day going?`;
                if (stage !== 3) {
                    $('#greeting').html(val)
                    stage = 3
                }
            } else if (hour < 12) {
                var val = `Good Morning {{ $admin['adm_firstname'] }} , How was your night?`;
                if (stage !== 4) {
                    $('#greeting').html(val)
                    stage = 4
                }
            }
            return val;
        };
        setInterval(() => {
            greeting()
            console.log();
        }, 1000);
    </script>
    <script src="/js/preloader.js?v={{ env('APP_VERSION') }}"></script>
    <!-- Page JS -->
    <script src="/dashboard/assets/js/dashboards-analytics.js?v={{ env('APP_VERSION') }}"></script>
</body>

</html>
