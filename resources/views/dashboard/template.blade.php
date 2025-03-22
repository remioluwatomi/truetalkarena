<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="/dashboard/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Account settings - Account | True Talk Arena</title>

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

    <link rel="stylesheet" type="text/css"
        href="/jquery-confirm-v3.3.4/css/jquery-confirm.css?v={{ env('APP_VERSION') }}" />
    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="/dashboard/assets/vendor/js/helpers.js?v={{ env('APP_VERSION') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js?v={{ env('APP_VERSION') }} in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/dashboard/assets/js/config.js?v={{ env('APP_VERSION') }}"></script>
    <link href="/dashboard/assets/vendor/quill/quill.snow.css?v={{ env('APP_VERSION') }}" rel="stylesheet">
    <link href="/dashboard/assets/vendor/quill/quill.bubble.css?v={{ env('APP_VERSION') }}" rel="stylesheet">
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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Posts /</span>
                            Templates</h4>

                        <div class="row">
                            <div class="col-md-12">


                                <div class="card mb-4">
                                    <h5 class="card-header">Templates</h5>

                                    <div class="card-body pb-0">
                                        <h5 class="card-title">Add Templates <span></span></h5>
                                        {{-- `temp_id`, `data_name`, `data_type`, `data_x`, `data_y`, `data_font_size`, `data_font_family`, `data_width`, `data_height` --}}
                                        <form id="add-template">
                                            <input type="hidden" name="temp_id" value="{{ $template['temp_id'] }}">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" placeholder="Name"
                                                        name="data_name" required>
                                                </div>
                                                <div class="col-md-2">
                                                    <select class="form-select" name="data_type" id="data_type"
                                                        aria-label="Data Type" required>
                                                        <option selected="">Open this select menu</option>
                                                        <option value="value">value</option>
                                                        <option value="image">Image</option>
                                                        <option value="options">Options</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" class="form-control" placeholder="x"
                                                        name="data_x" required>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" class="form-control" placeholder="y"
                                                        name="data_y" required>
                                                </div>
                                                <div id="value-elements">

                                                </div>
                                            </div>
                                            <br>
                                            <center> <button type="submit" class="btn btn-primary">Submit</button>
                                            </center>
                                        </form>
                                        <hr>
                                        <br>

                                        <h5 class="card-title">Update Templates <span></span></h5>
                                        <div class="news">
                                            @foreach ($templates as $key => $item)
                                                <form class="update-template">
                                                    <input type="hidden" name="temp_data_id"
                                                        value="{{ $item['temp_data_id'] }}">
                                                    <div class="row">
                                                        <div class="col-md-2">name
                                                            <input type="text" class="form-control"
                                                                placeholder="Name" name="data_name"
                                                                value="{{ $item['data_name'] }}" required>
                                                        </div>
                                                        <div class="col-md-2">type
                                                            <input type="text" class="form-control" name="data_type"
                                                                value="{{ $item['data_type'] }}" readonly>
                                                        </div>
                                                        <div class="col-md-2">x
                                                            <input type="number" class="form-control"
                                                                placeholder="x"
                                                                name="data_x"value="{{ $item['data_x'] }}" required>
                                                        </div>
                                                        <div class="col-md-2">y
                                                            <input type="number" class="form-control"
                                                                placeholder="y"
                                                                name="data_y"value="{{ $item['data_y'] }}" required>
                                                        </div>
                                                        @switch($item['data_type'])
                                                            @case('image')
                                                                <div class="col-md-2">width
                                                                    <input type="text" class="form-control"
                                                                        placeholder="width"
                                                                        name="data_width"value="{{ $item['data_width'] }}"
                                                                        required>
                                                                </div>
                                                                <div class="col-md-2">height
                                                                    <input type="text" class="form-control"
                                                                        placeholder="height"
                                                                        name="data_height"value="{{ $item['data_height'] }}"
                                                                        required>
                                                                </div>
                                                            @break

                                                            @case('options')
                                                                <div class="col-md-2">font size
                                                                    <input type="text" class="form-control"
                                                                        placeholder="font size"
                                                                        name="data_font_size"value="{{ $item['data_font_size'] }}"
                                                                        required>
                                                                </div>
                                                                <div class="col-md-2">font family
                                                                    <input type="text" class="form-control"
                                                                        placeholder="font family"
                                                                        name="data_font_family"value="{{ $item['data_font_family'] }}"
                                                                        required>
                                                                </div>
                                                                <div class="col-md-12">Options(save as: opt1,opt2,opt3...)
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Options" name="data_options"
                                                                        value="{{ $item['data_options'] }}" required>

                                                                </div>
                                                            @break

                                                            @default
                                                                <div class="col-md-2">font size
                                                                    <input type="text" class="form-control"
                                                                        placeholder="font size"
                                                                        name="data_font_size"value="{{ $item['data_font_size'] }}"
                                                                        required>
                                                                </div>
                                                                <div class="col-md-2">font family
                                                                    <input type="text" class="form-control"
                                                                        placeholder="font family"
                                                                        name="data_font_family"value="{{ $item['data_font_family'] }}"
                                                                        required>
                                                                </div>
                                                        @endswitch
                                                    </div>
                                                    <br>
                                                    <center>
                                                        <div class="btn-group" role="group"
                                                            aria-label="Basic example">
                                                            <button type="submit"
                                                                class="btn btn-primary">Submit</button>
                                                            <button type="button" class="btn btn-danger"
                                                                onclick="deleteData({{ $item['temp_data_id'] }})">Delete</button>
                                                        </div>
                                                    </center>
                                                </form>
                                                <hr>
                                            @endforeach
                                        </div><!-- End sidebar recent posts-->
                                        <br>
                                    </div>


                                    <!-- /Account -->
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

    <!-- Main JS -->
    <script src="/dashboard/assets/js/main.js?v={{ env('APP_VERSION') }}"></script>
    <script type="text/javascript" src="/jquery-confirm-v3.3.4/js/jquery-confirm.js?v={{ env('APP_VERSION') }}"></script>
    {{-- <script>
     $.alert({
                    theme: "modern",
                    title: 'data.title',
                    icon: `fa fa-bell`,
                    type: 'green',
                    content: 'data.message',
                });
</script> --}}
    <!-- Page JS -->
    <script src="/dashboard/assets/vendor/quill/quill.min.js?v={{ env('APP_VERSION') }}"></script>
    <script src="/assets/js/preloader.js?v={{ env('APP_VERSION') }}"></script>
    <script src="/dashboard/js/templates.js?v={{ env('APP_VERSION') }}?v=1"></script>

</body>

</html>
