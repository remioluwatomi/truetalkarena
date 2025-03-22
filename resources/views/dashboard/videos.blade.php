@php
function getvideolink($uri)
{
    $videoId = str_replace('https://www.youtube.com/watch?v=', '', $uri);
    // var videoId = str.replace("https://www.youtube.com/watch?v=", "");
    $result = "http://img.youtube.com/vi/$videoId/0.jpg";
    return $result;
}
@endphp
<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="/dashboard/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Videos | True Talk Arena</title>

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
    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="/magnific-popup/dist/magnific-popup.css">

    <style>
        .video-image-div {
            position: relative;
        }

        .overlay-play {
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            top: 0;
            right: 0;
            left: 0;
            left: 0;
        }

        .overlay-play i {
            font-size: 50px;
            color: #fff
        }
    </style>
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
                            Videos</h4>

                        <div class="row">
                            <div class="col-md-12">


                                <div class="card mb-4">
                                    <h5 class="card-header">Video</h5>
                                    <a class="btn btn-primary" href="#" onclick="return false;"
                                        data-bs-toggle="modal" data-bs-target="#addNews"><i
                                            class="bi bi-plus-circle-dotted"></i>
                                        Add</a>
                                    <!-- Account -->
                                    <div class="modal fade" id="addNews" tabindex="-1">
                                        <div class="modal-dialog  modal-fullscreen">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Video</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="form-container" class="container">
                                                        <form id="video-add">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="display_name">Video Title</label>
                                                                        <input class="form-control" name="video_title"
                                                                            type="text" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="display_name">Youtube Link</label>
                                                                        <input class="form-control" name="video_url"
                                                                            type="text" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label for="Video_body">Description</label>
                                                                <textarea name="video_desc" class="form-control" cols="30" rows="10"></textarea>
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
                                        <h5 class="card-title">Video &amp; Updates <span></span></h5>

                                        <div class="news">

                                            @foreach ($videos as $key => $item)
                                                <!-- Card with an image on left -->
                                                <div class="card mb-3">
                                                    <div class="row g-0">
                                                        <div class="col-md-4 video-image-div"
                                                            id="video-image-{{ $key }}">

                                                            <img src="{{ getvideolink($item['video_url']) }}"
                                                                class="img-fluid rounded-start" alt="video_url"> <a
                                                                class="overlay-play popup-videos"
                                                                href="{{ $item['video_url'] }}}"><i
                                                                    class=" tf-icons bx bx-play-circle"></i><a>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card-body">
                                                                <h5 class="card-title">{{ $item['video_title'] }}</h5>
                                                                <p class="card-text">{!! substr($item['video_desc'], 0, 50) !!}...</p>
                                                                <center><button class="btn btn-info"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#view-{{ $key }}">Edit</button>
                                                                </center>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Card with an image on left -->
                                            @endforeach
                                        </div><!-- End sidebar recent posts-->

                                    </div>
                                    <div class="card-footer pb-0">
                                        <!-- Pagination
                                    ============================================= -->
                                        <center>{!! $videos->links() !!}</center>
                                        <!-- Paginations end -->
                                    </div>

                                    <!-- /Account -->
                                </div>
                                @foreach ($videos as $key => $item)
                                    <div class="modal fade" id="view-{{ $key }}" tabindex="-1">
                                        <div class="modal-dialog  modal-fullscreen">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ $item['video_title'] }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="video-update">
                                                        <div class="row">
                                                            <input class="form-control" name="video_id"
                                                                value="{{ $item['video_id'] }}" type="hidden"
                                                                required>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="display_name">Video Title</label>
                                                                    <input class="form-control" name="video_title"
                                                                        value="{{ $item['video_title'] }}"
                                                                        type="text" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="display_name">Youtube Link</label>
                                                                    <input class="form-control" name="video_url"
                                                                        value="{{ $item['video_url'] }}"
                                                                        type="text" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="Video_body">Description</label>
                                                            <textarea name="video_desc" class="form-control" cols="30" rows="10">{{ $item['video_desc'] }}</textarea>
                                                        </div>
                                                        <div class="row">
                                                            <button class="btn btn-primary"
                                                                type="submit">Save</button>
                                                        </div>
                                                    </form>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="deleteBlog({{ $item['video_id'] }})">Delete</button>
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
    <script src="/magnific-popup/libs/jquery/jquery.js"></script>
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
    <script src="/js/preloader.js?v={{ env('APP_VERSION') }}"></script>
    <script src="/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
    <script src="/dashboard/js/videos.js?v={{ env('APP_VERSION') }}"></script>

    <script>
        $(document).ready(function() {
            $(".popup-videos").magnificPopup({
                disableOn: 10,
                type: "iframe",
                mainClass: "mfp-fade",
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false,
            });
        });
    </script>

</body>

</html>
