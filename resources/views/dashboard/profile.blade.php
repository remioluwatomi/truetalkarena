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
                            Account</h4>

                        <div class="row">
                            <div class="col-md-12">

                                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="javascript:void(0);" role="tab"
                                            data-bs-toggle="tab" data-bs-target="#navs-pills-top-home"><i
                                                class="bx bx-user me-1"></i> Account</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#!" data-bs-target="#navs-pills-top-password"
                                            data-bs-toggle="tab"><i class="bx bx-lock-open-alt me-1"></i> Change
                                            Password</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">

                                        <div class="card mb-4">
                                            <h5 class="card-header">Profile Details</h5>
                                            <!-- Account -->
                                            <div class="card-body">
                                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                    <img src="/dashboard/assets/img/avatars/1.png" alt="user-avatar"
                                                        class="d-block rounded" height="100" width="100"
                                                        id="uploadedAvatar" />
                                                    <input type="hidden" id="userID" value="{{ $admin['adm_id'] }}">
                                                </div>
                                            </div>
                                            <hr class="my-0" />
                                            <div class="card-body">
                                                <form id="profile-user">
                                                    <div class="row">
                                                        <div class="mb-3 col-md-6">
                                                            <label for="firstName" class="form-label">First Name</label>
                                                            <input class="form-control" type="text"
                                                                id="adm_firstname" name="adm_firstname"
                                                                value="{{ $admin['adm_firstname'] }}" autofocus />
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="lastname" class="form-label">Last Name</label>
                                                            <input class="form-control" type="text" id="adm_lastname"
                                                                name="adm_lastname"
                                                                value="{{ $admin['adm_lastname'] }}" autofocus />
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="email" class="form-label">E-mail</label>
                                                            <input class="form-control" type="text" id="email"
                                                                name="adm_email" value="{{ $admin['adm_email'] }}"
                                                                placeholder="john.doe@example.com" readonly />
                                                        </div>
                                                    </div>
                                                    <div class="mt-2">
                                                        <button type="submit" class="btn btn-primary me-2">Save
                                                            changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /Account -->
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="navs-pills-top-password" role="tabpanel">
                                        <div class="card mb-4">
                                            <h5 class="card-header">Change Password</h5>

                                            <hr class="my-0" />
                                            <div class="card-body">
                                                <form id="ChangePassword">
                                                    <div class="row spec">

                                                        <div class="form-floating mb-3">
                                                            <input type="password" class="form-control"
                                                                name="oldPassword" id="floatingoldPassword"
                                                                required="" />
                                                            <label for="oldPassword">
                                                                Old Password
                                                            </label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input type="password" class="form-control"
                                                                name="password" id="password" required="" />
                                                            <label for="password">
                                                                New Password
                                                            </label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input type="password" class="form-control"
                                                                name="comfirmPassword" id="confirm_password"
                                                                required="" />
                                                            <label for="confirm_password">
                                                                Comfirm Password
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <div class="custom-control custom-checkbox">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="check1" disabled />
                                                                <label class="form-check-label" for="check1">
                                                                    Password up to 6
                                                                    characters
                                                                </label>
                                                            </div>
                                                        </li>
                                                        {{-- <li class="list-group-item">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" style="background: green "
                                                                class=" custom-control-input" id="check3" disabled />
                                                            <label class="form-check-label" for="check3">
                                                                Password contains
                                                                special characters.
                                                            </label>
                                                        </div>
                                                    </li> --}}
                                                        {{-- <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" id="disabledCheck1" disabled />
                                                            <label class="form-check-label" for="disabledCheck1">
                                                                Disabled Unchecked </label>
                                                        </div> --}}
                                                        <li class="list-group-item">
                                                            <div class="custom-control custom-checkbox">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="check4" disabled />
                                                                <label class="form-check-label" for="check4">
                                                                    Password contains
                                                                    numeric characters.
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="custom-control custom-checkbox">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="check2" disabled />
                                                                <label class="form-check-label" for="check2">
                                                                    Password Matching.
                                                                </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <button id="submit" type="submit"
                                                        class="btn btn-primary disabled">
                                                        Submit
                                                    </button>
                                                </form>
                                            </div>
                                            <!-- /Account -->
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="card">
                                    <h5 class="card-header">Delete Account</h5>
                                    <div class="card-body">
                                        <div class="mb-3 col-12 mb-0">
                                            <div class="alert alert-warning">
                                                <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete
                                                    your account?</h6>
                                                <p class="mb-0">Once you delete your account, there is no going back.
                                                    Please be certain.</p>
                                            </div>
                                        </div>
                                        <form id="formAccountDeactivation" onsubmit="return false">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox"
                                                    name="accountActivation" id="accountActivation" />
                                                <label class="form-check-label" for="accountActivation">I confirm my
                                                    account deactivation</label>
                                            </div>
                                            <button type="submit"
                                                class="btn btn-danger deactivate-account">Deactivate Account</button>
                                        </form>
                                    </div>
                                </div> --}}
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
    <script src="/dashboard/assets/js/pages-account-settings-account.js?v={{ env('APP_VERSION') }}"></script>
    <script src="/js/preloader.js?v={{ env('APP_VERSION') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js?v={{ env('APP_VERSION') }}"></script>
</body>

</html>
