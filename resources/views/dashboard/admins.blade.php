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
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Admins</h4>
                                        <p class="card-description">
                                            <button class="btn btn-sm btn-primary float-right" data-bs-toggle="modal"
                                                data-bs-target="#add-Staff">
                                                <i class="mdi mdi-account-plus"></i> Add
                                            </button>
                                        </p>
                                        <div class="table-responsive">
                                            <table id="admins" class="table table-hover"></table>
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



        <div class="modal fade" id="add-Staff" tabIndex="-1" data-bs-backdrop="static" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" style="backdrop-filter: blur(5px)">
            <div class="modal-dialog modal-fullscreen" role="document">
                <div class="modal-content glass-panel">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color: #fff">
                            Add Staff
                        </h5>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <form id="addStaff">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 pr-md-1">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" placeholder="Your Name"
                                                    name="adm_firstname" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 px-md-1">
                                            <div class="form-group">
                                                <label>Last name</label>
                                                <input type="text" class="form-control" placeholder="Your Name"
                                                    name="adm_lastname" required />
                                            </div>
                                        </div>
                                        <div class="col-md-12 pr-md-1">
                                            <div class="form-group">
                                                <label>Email address</label>
                                                <input type="email" class="form-control" placeholder="Your Email"
                                                    name="adm_email" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-md-1">
                                            <div class="form-group">
                                                <label>Phone number</label>
                                                <input type="text" class="form-control" id="phoneInput"
                                                    data-bs-mask="(+234) 999-999-9999" placeholder="Phone number"
                                                    name="adm_tel" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 pr-md-1">
                                            <div class="form-group">
                                                <label>Level</label>
                                                <input type="number" class="form-control" id="level"
                                                    min="1" max="10" placeholder="level"
                                                    name="adm_level" required />
                                            </div>
                                        </div>

                                        <div class="col-md-12 pr-md-1">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control" placeholder="Title"
                                                    name="adm_title" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-buttons">
                                        <button type="submit" class="btn btn-success glass-button">
                                            Save
                                        </button>

                                        <button type="reset" class="btn btn-fill btn-secondary glass-button"
                                            id="resetBtn2">
                                            Reset
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editStaff" tabIndex="-1" data-bs-backdrop="static" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" style="backdrop-filter: blur(5px)">
            <div class="modal-dialog modal-fullscreen" role="document">
                <div class="modal-content glass-panel">
                    <div class="modal-header">
                        <h5 class="modal-title" style=" color: #000">
                        </h5>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="title">Add Service</h5>
                            </div>
                            <form id="updateStaff">
                                <div class="card-body">

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-fill glass-button">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
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

    <script src="/js/preloader.js?v={{ env('APP_VERSION') }}"></script>
    <!-- Page JS -->
    <script src="/DataTables/datatables.min.js"></script>
    @isset($port)
        <script>
            $('#edit-admin').modal('show');
        </script>
    @endisset
    <script>
        const admins = {!! json_encode($admins) !!}
        const data = {!! json_encode($admins) !!}

        console.log(data);
        const columns = [{
                title: "Firstname",
                data: "adm_firstname",
                sortable: true,
            },
            {
                title: "Lastname",
                data: "adm_lastname",
                sortable: true,
            },
            {
                title: "Email",
                data: "adm_email",
                sortable: true,
                filterable: true,
            },
            {
                title: "Title",
                data: "adm_title",
                sortable: true,
                filterable: true,
            },
            {
                title: "Status",
                data: "adm_status",
                sortable: true,
                render: (status) => {
                    if (status === "active") {
                        return (
                            `<span class="btn btn-sm btn-primary">
        <span class="mdi mdi-account-star"></span>
      </span>`
                        );
                    } else if (status === "inactive") {
                        return (`
      <span class="btn btn-sm btn-secondary">
        <span class="mdi mdi-account-convert"></span>
      </span>
    `)
                    } {
                        return (`
      <span class="btn btn-sm btn-danger">
        <span class="mdi mdi-account-off"></span>
      </span>
    `);
                    }
                },
            },
            {
                title: "Action",
                data: "adm_id",
                sortable: true,
                render: (x) => {
                    const item = JSON.stringify(data.filter((i) => i.adm_id === x)[0]);
                    return (`
      <div class="btn-group" role="group" aria-label="Basic example">
        <button
          type="button"
          class="btn btn-primary"
          onClick='activateStaff(${x})'
        >
          <span class="mdi mdi-account-check" id={${x}}></span>
        </button>
        <button
          type="button"
          class="btn "
          data-bs-toggle="modal"
          data-bs-target="#editStaff"
          onClick='getStaff(${item})'
        >
          <span class="mdi mdi-pencil-box-outline"></span>
        </button>
        <button
          type="button"
          class="btn btn-danger"
          onClick='deactivateStaff(${x})'
        >
          <span class="mdi mdi-delete"></span>
        </button>
      </div>
    `);
                },
            },
        ];
        $(document).ready(function() {
            var table = $('#admins').DataTable({
                data,
                columns,
                buttons: ['copy', 'pdf']
            });
        })
    </script>

    <script src="/dashboard/assets/js/admins.js?v={{ env('APP_VERSION') }}"></script>
</body>

</html>
