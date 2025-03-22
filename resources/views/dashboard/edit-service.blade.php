<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="/dashboard/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Services - True Talk Arena</title>

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
    <link rel="stylesheet" type="text/css"
        href="/jquery-confirm-v3.3.4/css/jquery-confirm.css?v={{ env('APP_VERSION') }}" />

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
                            <div class="col-lg-12 mb-4 order-0">
                                <div class="card">
                                    <div class="d-flex align-items-end row">
                                        <div class="col-sm-12">
                                            <div class="card-body all-icons">
                                                <div class="row">
                                                    <div class="col-12">

                                                        <form id="editService">
                                                            <div class="card-body">
                                                                <input type="hidden" id="serv_id" name="serv_id"
                                                                    value='{{ $serv['serv_id'] }}' readOnly />
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-sm-12" style="width: 200px">
                                                                            <img class="img-rounded" id="display-bg"
                                                                                width="100%"
                                                                                src="/assets/img/services/{{ $serv['serv_img'] }}">
                                                                            <label class="change-link btn btn-primary"
                                                                                style="width: 200px"
                                                                                for="serv_img">Service
                                                                                picture (in .png)</label><input
                                                                                name="serv_img" type="file"
                                                                                style="display: none" id="serv_img"
                                                                                onchange="const file = this.files[0];
                                                                            console.log(file);
                                                                            if (file){
                                                                              let reader = new FileReader();
                                                                              reader.onload = function(event){
                                                                                console.log(event.target.result);
                                                                                $('#display-bg').attr('src', event.target.result);
                                                                              }
                                                                              reader.readAsDataURL(file);
                                                                            }">
                                                                        </div>
                                                                        <div class="col-md-12 pr-md-1">
                                                                            <div class="form-group">
                                                                                <label>Service Name</label>
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    placeholder="Service Name"
                                                                                    name="service"
                                                                                    value='{{ $serv['service'] }}'
                                                                                    required />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Service Desc</label>
                                                                                <textarea rows="4" cols="80" class="form-control" placeholder="Here can be your description"
                                                                                    name="serv_desc">{{ $serv['serv_desc'] }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <button type="submit"
                                                                        class="btn btn-primary glass-button">
                                                                        Save
                                                                    </button>
                                                                </div>
                                                        </form>
                                                    </div>
                                                </div>
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

        <div class="modal fade" id="add-service" tabIndex="-1" data-backdrop="static" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" style="backdrop-filter: blur(5px)">
            <div class="modal-dialog modal-fullscreen" role="document">
                <div class="modal-content glass-panel">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color: #fff">
                            Add Service
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="title">Add Service</h5>
                            </div>
                            <form id="addService">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-12 pr-md-1">
                                            <div class="form-group">
                                                <label>Service Name</label>
                                                <input type="text" class="form-control" placeholder="Service Name"
                                                    name="service" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Service Desc</label>
                                                <textarea rows="4" cols="80" class="form-control" placeholder="Here can be your description"
                                                    name="serv_desc"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary glass-button">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
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
    <script type="text/javascript" src="/jquery-confirm-v3.3.4/js/jquery-confirm.js?v={{ env('APP_VERSION') }}"></script>

    <!-- Main JS -->
    <script src="/dashboard/assets/js/main.js?v={{ env('APP_VERSION') }}"></script>

    <script src="/assets/js/preloader.js?v={{ env('APP_VERSION') }}"></script>
    <!-- Page JS -->
    <script src="/dashboard/js/edit-service.js?v={{ env('APP_VERSION') }}"></script>
</body>

</html>
