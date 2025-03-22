<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="/dashboard/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Books | True Talk Arena</title>

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
                        {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Posts /</span>
                            Videos</h4> --}}
                        <div class="page-header">
                            <h3 class="page-title">
                                <span class="page-title-icon bg-gradient-primary text-white me-2">
                                    <i class="mdi mdi-image-filter"></i>
                                </span> books
                            </h3>
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <button
                                            class="btn btn-primary page-title-icon bg-gradient-primary text-white me-2"
                                            data-bs-toggle="modal" data-bs-target="#addModal"><i
                                                class="mdi mdi-image"></i>
                                            Add</button>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="row">
                            <div class="col-md-12">


                                <div class="card mb-4">

                                    <!-- Account -->
                                    <div class="card-body pb-0">
                                        <div class="news row">

                                            @foreach ($books as $key => $item)
                                                <div class="col-md-4 grid-margin stretch-card">
                                                    <div class="card books">
                                                        <a href="#!">
                                                            <img src="/assets/img/books/{{ $item['book_cover'] }}"
                                                                class="card-img-top" alt="books Image">
                                                        </a>

                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $item['book_name'] }}</h5>
                                                            <p class="card-text">{{ $item['book_desc'] }}</p>
                                                            <button class="btn btn-outline-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#event-{{ $key }}"><i
                                                                    class="bx bx-pencil"></i></button>
                                                            <a class="btn btn-outline-primary" target="_blank"
                                                                href="/assets/img/books/pdf/{{ $item['book_url'] }}"
                                                                download="/assets/img/books/pdf/{{ $item['book_url'] }}"><i
                                                                    class="bx bx-link"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div><!-- End sidebar recent posts-->

                                    </div>
                                    <div class="card-footer pb-0">
                                        <!-- Pagination ============================================= -->
                                        <center>{!! $books->links() !!}</center>
                                        <!-- Paginations end -->
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
    <div class="modal modal-adminpro-general fullwidth-popup-InformationproModal fade" id="addModal" tabindex="-1"
        role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header header-color-modal bg-color-2">
                    <h4 class="modal-title">Add Book</h4>
                    <div class="modal-close-area modal-close-df">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">

                        <form id="createEvent" method="post">
                            <div class="row">
                                <div class="col-6">
                                    <img src="/images/others/default.jpg" class=" w-100 rounded" alt="image"
                                        id="display-img">
                                </div>
                                <div class="col-6">
                                    <img src="/images/others/default.jpg" class=" w-100 rounded" alt="image"
                                        id="display-img-back">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Book Cover - Front</label>

                                <div class="input-group col-xs-12">
                                    <input class="form-control" type="file" name="book_cover"
                                        onchange="const file = this.files[0];
                                console.log(file);
                                if (file){
                                  let reader = new FileReader();
                                  reader.onload = function(event){
                                    console.log(event.target.result);
                                    $('#display-img').attr('src', event.target.result);
                                  }
                                  reader.readAsDataURL(file);
                                }">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Book Cover - Back</label>

                                <div class="input-group col-xs-12">
                                    <input class="form-control" type="file" name="book_back"
                                        onchange="const file = this.files[0];
                                console.log(file);
                                if (file){
                                  let reader = new FileReader();
                                  reader.onload = function(event){
                                    console.log(event.target.result);
                                    $('#display-img-back').attr('src', event.target.result);
                                  }
                                  reader.readAsDataURL(file);
                                }">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="book_title">Book Title</label>
                                    <input class="form-control" name="book_name" type="text" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="book_url">Book (ebook/pdf)</label>
                                    <input class="form-control" type="file" name="book_url" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="book_url">Book Price (&#163;)</label>
                                    <input class="form-control"name="book_price" type="decimal" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="book_desc">Book Description</label>
                                    <textarea name="book_desc" class="form-control" required></textarea>
                                </div>
                            </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary " type="submit" style="color:white">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($books as $key => $item)
        <div class="modal modal-adminpro-general fullwidth-popup-InformationproModal fade"
            id="event-{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header header-color-modal bg-color-2">
                        <h4 class="modal-title">{{ $item['book_name'] }}</h4>
                        <div class="modal-close-area modal-close-df">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">

                            <form class="updateGallery" method="post">
                                <input type="hidden" name="book_id" value="{{ $item['book_id'] }}">
                                <div class="row">
                                    <div class="col-6">
                                        <img src="/assets/img/books/{{ $item['book_cover'] }}" class=" w-100 rounded"
                                            alt="image" id="display-img{{ $key }}">
                                    </div>
                                    <div class="col-6">
                                        <img src="/assets/img/books/{{ $item['book_back'] }}" class=" w-100 rounded"
                                            alt="image" id="display-img-{{ $key }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Book Cover - Front</label>

                                    <div class="input-group col-xs-6">
                                        <input class="form-control" type="file" name="book_cover"
                                            onchange="const file = this.files[0];
                                                              console.log(file);
                                                              if (file){
                                                                let reader = new FileReader();
                                                                reader.onload = function(event){
                                                                  console.log(event.target.result);
                                                                  $('#display-img{{ $key }}').attr('src', event.target.result);
                                                                }
                                                                reader.readAsDataURL(file);
                                                              }">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Book Cover - Back</label>
                                    <div class="input-group col-xs-6">
                                        <input class="form-control" type="file" name="book_back"
                                            onchange="const file = this.files[0];
                                                              console.log(file);
                                                              if (file){
                                                                let reader = new FileReader();
                                                                reader.onload = function(event){
                                                                  console.log(event.target.result);
                                                                  $('#display-img-{{ $key }}').attr('src', event.target.result);
                                                                }
                                                                reader.readAsDataURL(file);
                                                              }">
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="book_title">Book Title</label>
                                        <input class="form-control" name="book_name"
                                            value="{{ $item['book_name'] }}" type="text" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="book_url">Book (ebook/pdf)</label>
                                        <input class="form-control" type="file" name="book_url">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="book_url">Book Price (&#163;)</label>
                                        <input class="form-control" type="decimal"
                                            name="book_price"value="{{ $item['book_price'] }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="book_desc">Book Description</label>
                                        <textarea name="book_desc" class="form-control" required>{{ $item['book_desc'] }}</textarea>
                                    </div>
                                </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary " type="submit" style="color:white">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
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
    <script src="/dashboard/js/books.js?v={{ env('APP_VERSION') }}"></script>

</body>

</html>
