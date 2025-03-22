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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span>
                            General</h4>

                        <div class="row">
                            <div class="col-md-12">


                                <div class="card mb-4">
                                    <h5 class="card-header">Profile Details</h5>
                                    <!-- Account -->
                                    <div class="card-body">
                                        <div class="card-body">
                                            @if ($admin['adm_level'] > 4)
                                                <div class="alert alert-info alert-with-icon" data-notify="container">
                                                    <button type="button" aria-hidden="true" class="close"
                                                        data-dismiss="alert" aria-label="Close">
                                                        <i class="tim-icons icon-simple-remove"></i>
                                                    </button>
                                                    <span data-notify="icon" class="tim-icons icon-bell-55"></span>
                                                    <span data-notify="message">
                                                        Sorry, but you do not have authorization to assess this
                                                        page yet.
                                                    </span>
                                                </div>
                                            @else
                                                <form id="settings">
                                                    <div class="row">
                                                        @foreach ($infos as $item)
                                                            @switch($item['info_name'])
                                                                @case('discount deadline')
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ $item['info_name'] }}</label>
                                                                            <input type="datetime-local" class="form-control"
                                                                                placeholder="Here can be your description"
                                                                                name="{{ $item['info_name'] }}"
                                                                                value="{{ $item['info'] }}" />
                                                                        </div>
                                                                    </div>
                                                                @break

                                                                @case('email')
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ $item['info_name'] }}</label>
                                                                            <input type="email" class="form-control"
                                                                                placeholder="email"
                                                                                name="{{ $item['info_name'] }}"
                                                                                value="{{ $item['info'] }}" />
                                                                        </div>
                                                                    </div>
                                                                @break

                                                                @case('maintenance')
                                                                    @if ($admin['adm_level'] < 1)
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>{{ $item['info_name'] }}</label>
                                                                                <select class="form-control"
                                                                                    name="{{ $item['info_name'] }}">
                                                                                    <option value="false"
                                                                                        @if ($item['info'] == 'false') selected @endif>
                                                                                        false</option>
                                                                                    <option value="true"
                                                                                        @if ($item['info'] == 'true') selected @endif>
                                                                                        true</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @break

                                                                @case('tel')
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ $item['info_name'] }}</label>
                                                                            <input type="text" class="form-control"
                                                                                placeholder="Phone number"
                                                                                name="{{ $item['info_name'] }}"
                                                                                value="{{ $item['info'] }}" />
                                                                        </div>
                                                                    </div>
                                                                @break

                                                                @case('intro video')
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ $item['info_name'] }}</label>
                                                                            <input type="url" class="form-control"
                                                                                placeholder="Youtube link"
                                                                                name="{{ $item['info_name'] }}"
                                                                                value="{{ $item['info'] }}" />
                                                                        </div>
                                                                    </div>
                                                                @break

                                                                @case('privacy')
                                                                    <div class="row form-group">
                                                                        <label
                                                                            for="news_body">{{ $item['info_name'] }}</label>
                                                                        <input name="{{ $item['info_name'] }}" id="privacy"
                                                                            type="hidden">
                                                                        <div id="editor-container">
                                                                            {!! $item['info'] !!}
                                                                        </div>
                                                                    </div>
                                                                @break

                                                                @default
                                                                    <div class="col-md-6" key={index}>
                                                                        <div class="form-group">
                                                                            <label>{{ $item['info_name'] }}</label>
                                                                            <textarea rows="4" cols="80" class="form-control" placeholder="Here can be your description"
                                                                                name="{{ $item['info_name'] }}">{{ $item['info'] }}</textarea>
                                                                        </div>
                                                                    </div>
                                                            @endswitch
                                                        @endforeach

                                                    </div>
                                                    <div><br><br><br><br><br></div>
                                                    <center>
                                                        <button type="submit" class="btn btn-primary">
                                                            Submit
                                                        </button>
                                                    </center>
                                                </form>
                                                <div class="glass-panel"><button
                                                        class="btn btn-sm btn-primary float-right"
                                                        data-bs-toggle="modal" data-bs-target="#add-socials">
                                                        <i class="bi bi-plus"></i> Add
                                                    </button>

                                                    <h2>Socials</h2>
                                                    <div class="row">
                                                        <hr>
                                                        @foreach ($socials as $item)
                                                            <form class="socials row">
                                                                <input type="hidden" name="soc_id"
                                                                    value="{{ $item['soc_id'] }}">
                                                                <h3>{{ $item['soc_name'] }}</h3>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Name</label>
                                                                        <input type="text" class="form-control"
                                                                            name="soc_name"
                                                                            value="{{ $item['soc_name'] }}" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Link</label>
                                                                        <input type="text" class="form-control"
                                                                            name="soc_link"
                                                                            value="{{ $item['soc_link'] }}" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Icon</label>
                                                                        <input type="text" class="form-control"
                                                                            name="soc_icon"
                                                                            value="{{ $item['soc_icon'] }}" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Status</label>
                                                                        <select name="soc_status" class="form-control"
                                                                            required>
                                                                            <option value="active"
                                                                                @if ($item['soc_status'] === 'active') selected @endif>
                                                                                active</option>
                                                                            <option value="deactivated"
                                                                                @if ($item['soc_status'] === 'deactivated') selected @endif>
                                                                                deactivated</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <center>
                                                                    <button type="submit" class="btn btn-primary">
                                                                        Submit
                                                                    </button>
                                                                </center>
                                                                <hr>

                                                            </form>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- /Account -->
                                </div>
                                <div class="modal fade" id="add-socials" tabIndex="-1" data-backdrop="static"
                                    role="dialog" aria-labelledby="add-socials" aria-hidden="true"
                                    style="backdrop-filter: blur(5px)">
                                    <div class="modal-dialog modal-fullscreen" role="document">
                                        <div class="modal-content glass-panel">
                                            <div class="modal-header">
                                                <h5 class="modal-title" style="color: #fff">
                                                    Add Social
                                                </h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="title">Add Social</h5>
                                                    </div>
                                                    <form id="addSocial">
                                                        <div class="card-body">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <input type="text" class="form-control"
                                                                        name="soc_name" required />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Link</label>
                                                                    <input type="text" class="form-control"
                                                                        name="soc_link" required />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Icon</label>

                                                                    <select name="soc_icon" id=""
                                                                        class="form-control" required>
                                                                        <option value="bx bxl-twitter">Twitter</option>
                                                                        <option value="bx bxl-facebook">Facebook
                                                                        </option>
                                                                        <option value="bx bxl-instagram">Instagram
                                                                        </option>
                                                                        <option value="bx bxl-linkedin">Linkedin
                                                                        </option>
                                                                        <option value="bx bxl-github">Github</option>
                                                                        <option value="bx bxl-whatsapp">Whatsapp
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <button type="submit" class="btn btn-fill glass-button">
                                                                Save
                                                            </button>

                                                            <button type="reset"
                                                                class="btn btn-fill btn-warning glass-button"
                                                                id="resetBtn2" style="display: none">
                                                                Reset
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">
                                                    Close
                                                </button>
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

    <!-- Main JS -->
    <script src="/dashboard/assets/js/main.js?v={{ env('APP_VERSION') }}"></script>
    <script type="text/javascript" src="/jquery-confirm-v3.3.4/js/jquery-confirm.js?v={{ env('APP_VERSION') }}"></script>
    <script src="/dashboard/js/profile.js?v={{ env('APP_VERSION') }}"></script>

    <!-- Page JS -->
    <script src="/dashboard/assets/vendor/quill/quill.min.js?v={{ env('APP_VERSION') }}"></script>
    <script src="/dashboard/assets/js/pages-account-settings-account.js?v={{ env('APP_VERSION') }}"></script>
    <script src="/js/preloader.js?v={{ env('APP_VERSION') }}"></script>
    <script src="/dashboard/js/socials.js?v={{ env('APP_VERSION') }}"></script>
    <script>
        var quill = new Quill("#editor-container", {
            modules: {
                toolbar: [
                    ["bold", "italic"],
                    ["link", "blockquote", "code-block"],
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
        $("#settings").on("submit", function(event) {
            $("#preloader").show();
            // stop the form refreshing the page
            event.preventDefault();
            var privacy = document.querySelector("input[name=privacy]");
            privacy.value = quill.root.innerHTML.trim();


            $.ajax({
                url: "/api/updateSettings",
                data: $(this).serialize(),
                type: "post",
                dataType: "json",
                success: function(data) {
                    $.alert({
                        title: data.title,
                        icon: `fa ${data.icon}`,
                        type: data.type,
                        content: data.message,
                        theme: "modern",
                    });
                    $("#preloader").fadeOut(100, function() {
                        $("#preloader").removeClass("loading");
                    });
                },
                error: function(data) {
                    $.alert({
                        title: data.title,
                        icon: `fa ${data.icon}`,
                        type: "orange",
                        content: `Sorry! ${data.statusText}`,
                        theme: "modern",
                    });
                    $("#preloader").fadeOut(100, function() {
                        $("#preloader").removeClass("loading");
                    });
                },
            });
        });
    </script>
</body>

</html>
