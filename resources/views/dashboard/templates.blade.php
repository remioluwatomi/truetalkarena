<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="/dashboard/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Templates | True Talk Arena</title>

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
                                    <a class="btn btn-primary" href="#" onclick="return false;"
                                        data-bs-toggle="modal" data-bs-target="#addNews"><i
                                            class="bi bi-plus-circle-dotted"></i>
                                        Add</a>
                                    <!-- Account -->
                                    <div class="modal fade" id="addNews" tabindex="-1">
                                        <div class="modal-dialog  modal-fullscreen">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add news</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="form-container" class="container">
                                                        <form id="news-add">
                                                            <div class="row">
                                                                <div class="col-sm-4" style="width: 200px">
                                                                    <img class="img-rounded" id="display-img"
                                                                        width="100%" src="">
                                                                    <a class="change-link btn btn-primary"
                                                                        id="change-link" href='#'
                                                                        style="width: 200px">Template
                                                                        picture</a>
                                                                </div>
                                                                <div class="col-sm-4" style="width: 200px">
                                                                    <img class="img-rounded" id="display-img01"
                                                                        width="100%" src="">
                                                                    <label class="change-link btn btn-primary"
                                                                        id="change-link" href='#'
                                                                        style="width: 200px" for="temp_img">Display
                                                                        picture</label><input style="display: none"
                                                                        name="temp_img" type="file" id="temp_img"
                                                                        required
                                                                        onchange="const file = this.files[0];
                                                                        console.log(file);
                                                                        if (file){
                                                                          let reader = new FileReader();
                                                                          reader.onload = function(event){
                                                                            console.log(event.target.result);
                                                                            $('#display-img01').attr('src', event.target.result);
                                                                          }
                                                                          reader.readAsDataURL(file);
                                                                        }">
                                                                </div>
                                                                <input type="hidden" name="user_id"
                                                                    value="{{ $user['id'] }}">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for="display_name">Template
                                                                            Title</label>
                                                                        <input class="form-control" name="temp_title"
                                                                            type="text" required>
                                                                    </div><input style="display: none" name="temp_bg"
                                                                        type="file" id="temp_bg" required>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for="display_name">Template Write
                                                                            up</label>
                                                                        <input name="temp_desc" id="temp_desc"
                                                                            type="hidden">
                                                                        <div id="editor-container">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <button class="btn btn-primary"
                                                                    type="submit">Save</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End Vertically centered Modal-->
                                    <div class="card-body pb-0">
                                        <h5 class="card-title">Templates <span></span></h5>

                                        <div class="news">
                                            @foreach ($templates as $key => $item)
                                                <div class="post-item clearfix clickable" data-bs-toggle="modal"
                                                    data-bs-target="#view-{{ $key }}">
                                                    <img src="/assets/img/templates/{{ $item['temp_bg'] }}"
                                                        alt="" width="30%">
                                                    <h4><a href="#">{{ $item['temp_title'] }}</a></h4>

                                                </div>
                                            @endforeach
                                        </div><!-- End sidebar recent posts-->

                                    </div>
                                    <div class="card-footer pb-0">
                                        <!-- Pagination
                                    ============================================= -->
                                        <center>{!! $templates->links() !!}</center>
                                        <!-- Paginations end -->
                                    </div>

                                    <!-- /Account -->
                                </div>
                                @foreach ($templates as $key => $item)
                                    <div class="modal fade" id="view-{{ $key }}" tabindex="-1">
                                        <div class="modal-dialog  modal-fullscreen">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ $item['temp_title'] }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                        <img src="/assets/img/templates/{{ $item['temp_bg'] }}"
                                                            class="card-img-top" alt="..." style="width:100%">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $item['temp_title'] }}</h5>
                                                            {!! $item['temp_desc'] !!}
                                                            <form class="news-update">
                                                                <div class="row">
                                                                    <input type="hidden" name="temp_id"
                                                                        value="{{ $item['temp_id'] }}">

                                                                    <div class="col-sm-12" style="width: 200px">
                                                                        <img class="img-rounded"
                                                                            id="display-bg{{ $key }}"
                                                                            width="100%" src="">
                                                                        <label class="change-link btn btn-primary"
                                                                            style="width: 200px"
                                                                            for="temp_bg{{ $key }}">Template
                                                                            picture</label><input style="display: none"
                                                                            name="temp_bg" type="file"
                                                                            id="temp_bg{{ $key }}"
                                                                            onchange="const file = this.files[0];
                                                                        console.log(file);
                                                                        if (file){
                                                                          let reader = new FileReader();
                                                                          reader.onload = function(event){
                                                                            console.log(event.target.result);
                                                                            $('#display-bg{{ $key }}').attr('src', event.target.result);
                                                                          }
                                                                          reader.readAsDataURL(file);
                                                                        }">
                                                                    </div>
                                                                    <div class="col-sm-12" style="width: 200px">
                                                                        <img class="img-rounded"
                                                                            id="img-display-{{ $key }}"
                                                                            width="100%" src="">
                                                                        <label class="change-link btn btn-primary"
                                                                            style="width: 200px"
                                                                            for="temp_img{{ $key }}">Display
                                                                            picture</label><input style="display: none"
                                                                            name="temp_img" type="file"
                                                                            id="temp_img{{ $key }}"
                                                                            onchange="const file = this.files[0];
                                                                        console.log(file);
                                                                        if (file){
                                                                          let reader = new FileReader();
                                                                          reader.onload = function(event){
                                                                            console.log(event.target.result);
                                                                            $('#img-display-{{ $key }}').attr('src', event.target.result);
                                                                          }
                                                                          reader.readAsDataURL(file);
                                                                        }">
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="display_name">Template
                                                                                Title</label>
                                                                            <input class="form-control"
                                                                                name="temp_title" type="text"
                                                                                required
                                                                                value="{{ $item['temp_title'] }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="display_name">Template
                                                                                Status</label>
                                                                            <select name="temp_status"
                                                                                class="form-control" required>
                                                                                <option value="active"
                                                                                    @if ($item['temp_status'] == 'active') selected @endif>
                                                                                    activate</option>
                                                                                <option
                                                                                    value="deactivated"@if ($item['temp_status'] == 'deactivated') selected @endif>
                                                                                    deactivate</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="temp_width">Template
                                                                                Width</label>
                                                                            <input name="temp_width"
                                                                                class="form-control"
                                                                                value="{{ $item['temp_width'] }}"
                                                                                required />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="temp_height">Template
                                                                                Height</label>
                                                                            <input name="temp_height"
                                                                                class="form-control"
                                                                                value="{{ $item['temp_height'] }}"
                                                                                required />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="display_name">Template Write
                                                                                up</label>
                                                                            <input name="temp_desc"
                                                                                id="temp_desc{{ $item['temp_id'] }}"
                                                                                type="hidden">
                                                                            <div
                                                                                id="editor-container{{ $item['temp_id'] }}">
                                                                                {!! $item['temp_desc'] !!}
                                                                            </div>
                                                                            {{-- <textarea class="form-control" name="temp_desc" type="text" required>{{ $item['temp_desc'] }}</textarea> --}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <button class="btn btn-primary"
                                                                        type="submit">Save</button>
                                                                </div>
                                                            </form>
                                                            <br>
                                                            <div class="btn-group" role="group"
                                                                aria-label="Basic example">
                                                                <a href="/User/Templates/{{ $item['temp_slug'] }}"
                                                                    class="btn btn-primary">Edit Details</a>
                                                                <button type="button"
                                                                    onclick="deleteTemplate({{ $item['temp_id'] }})"
                                                                    class="btn btn-danger">Delete</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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

    <!-- Page JS -->
    <script src="/dashboard/assets/vendor/quill/quill.min.js?v={{ env('APP_VERSION') }}"></script>
    <script src="/assets/js/preloader.js?v={{ env('APP_VERSION') }}"></script>
    @foreach ($templates as $key => $item)
        <script>
            new Quill("#editor-container{{ $item['temp_id'] }}", {
                modules: {
                    toolbar: [
                        ["bold", "italic"],
                        ["link", "blockquote", "code-block", "image"],
                        [{
                                list: "ordered",
                            },
                            {
                                list: "bullet",
                            },
                        ],
                    ],
                },
                placeholder: "Compose an epic...",
                theme: "snow",
            });
        </script>
    @endforeach

    <script src="/dashboard/js/templates.js?v={{ env('APP_VERSION') }}"></script>

</body>

</html>
