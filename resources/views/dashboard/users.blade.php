@php
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return strtoupper($randomString);
}
@endphp
<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="/dashboard/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Users - True Talk Arena</title>

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

    <link rel="stylesheet" type="text/css"
        href="/jquery-confirm-v3.3.4/css/jquery-confirm.css?v={{ env('APP_VERSION') }}" />
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

                            <div class="text-right m-b-20">
                                <button data-bs-toggle="modal" data-bs-target="#add-service"
                                    style="float: right;right:0;" class="btn btn btn-primary btn-rounded float-right"><i
                                        class="bi bi-plus"></i> Add</button>

                            </div>
                        </div>
                        <section class="section">
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Users</h5>
                                            <div class="table-responsive">
                                                <table class="table datatable">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Fullname</th>
                                                            <th scope="col">Email</th>
                                                            <th scope="col">Title</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($admins as $key => $item)
                                                            <tr>
                                                                <th scope="row">{{ $key + 1 }}</th>
                                                                <td>{{ $item['firstname'] }} {{ $item['lastname'] }}
                                                                    ({{ $item['othername'] }})
                                                                </td>
                                                                <td><a
                                                                        href="mailto:{{ $item['email'] }}">{{ $item['email'] }}</a>
                                                                </td>
                                                                <td>{{ $item['title'] }}</td>
                                                                <td>
                                                                    @if ($item['status'] === 'active')
                                                                        <span class="btn btn-sm btn-primary">
                                                                            <span class="bx bx-user-check"></span>
                                                                        </span>
                                                                    @elseif($item['status'] === 'inactive')
                                                                        <span class="btn btn-sm btn-simple">
                                                                            <span class="fa fa-ellipsis-h"></span>
                                                                        </span>
                                                                    @else
                                                                        <span class="btn btn-sm btn-danger">
                                                                            <span class="bx bx-user-x"></span>
                                                                        </span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item['rank'] <= $admin['rank'])
                                                                        <button type="button" class="btn btn-light">
                                                                            <span>Not
                                                                                Authorized</span>
                                                                        </button>
                                                                    @else
                                                                        <div class="btn-group" role="group"
                                                                            aria-label="Basic example">
                                                                            <button type="button"
                                                                                class="btn btn-primary"
                                                                                onclick="activateStaff({{ $item['id'] }})">
                                                                                <span class="bi bi-check"
                                                                                    id={${x}}></span>
                                                                            </button>
                                                                            <button type="button" class="btn "
                                                                                data-toggle="modal"
                                                                                data-target="#editStaff"
                                                                                onclick="getStaff({!! json_encode($item) !!})">
                                                                                <span class="bi bi-pencil"></span>
                                                                            </button>
                                                                            <button type="button"
                                                                                class="btn btn-danger"
                                                                                onclick="deactivateStaff({{ $item['id'] }}})">
                                                                                <span class="bi bi-trash"></span>
                                                                            </button>
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </section>

                        <div class="modal fade" id="add-service" tabIndex="-1" data-backdrop="static" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true" style="backdrop-filter: blur(5px)">
                            <div class="modal-dialog modal-fullscreen" role="document">
                                <div class="modal-content glass-panel">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="color: #fff">
                                            Add Staff
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="title">Add Staff</h5>
                                            </div>
                                            <form id="formAuthentication">
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label for="username" class="form-label">Username</label>
                                                        <input type="text" class="form-control" id="username"
                                                            name="username" placeholder="Enter your username"
                                                            autofocus />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="text" class="form-control" id="email"
                                                            name="email" placeholder="Enter your email" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="rank" class="form-label">Rank</label>
                                                        <input type="number" class="form-control" id="rank"
                                                            name="rank" placeholder="Enter your rank" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="form-group">
                                                            <label>Title</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Title" name="title" required />
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 form-password-toggle" style="display: none">
                                                        <label class="form-label" for="password">Password</label>
                                                        <div class="input-group input-group-merge">
                                                            <input type="password" id="password"
                                                                class="form-control" name="password"
                                                                value="{{ generateRandomString() }}" />
                                                            <span class="input-group-text cursor-pointer"><i
                                                                    class="bx bx-hide"></i></span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-fill glass-button">
                                                        Save
                                                    </button>

                                                    <button type="reset"
                                                        class="btn btn-fill btn-warning glass-button" id="resetBtn2"
                                                        style="display: none">
                                                        Reset
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

    <script src="/assets/js/preloader.js?v={{ env('APP_VERSION') }}"></script>
    <!-- Page JS -->
    <script type="text/javascript" src="/jquery-confirm-v3.3.4/js/jquery-confirm.js?v={{ env('APP_VERSION') }}"></script>
    <script>
        $("#formAuthentication").on("submit", function(event) {
            $("#preloader").show();
            // stop the form refreshing the page
            event.preventDefault();
            console.log("submited");
            $.ajax({
                url: "/api/user/register",
                data: $(this).serialize(),
                type: "post",
                dataType: "json",
                success: function(data) {
                    if (data.type === "green") {
                        $.alert({
                            title: data.title,
                            icon: `fa ${data.icon}`,
                            type: data.type,
                            content: data.message,
                            onClose: function() {
                                window.location.href = '/User';
                            }
                        });
                    } else {
                        $.alert({
                            title: data.title,
                            icon: `fa ${data.icon}`,
                            type: data.type,
                            content: data.message,
                        });
                    }
                    $("#preloader").hide();
                },
                error: function(data) {
                    $.alert({
                        title: data.title,
                        icon: `fa ${data.icon}`,
                        type: "orange",
                        content: `Sorry! ${data.statusText}`,
                        theme: "modern",
                    });
                    $("#preloader").hide();
                },
            });
        });
    </script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js?v={{ env('APP_VERSION') }}"></script>
</body>

</html>
