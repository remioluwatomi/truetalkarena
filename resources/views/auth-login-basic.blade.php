@include('layouts.head')

<body>

    <!-- Main wrapper -->
    <div class="wrapper" id="wrapper">


        @include('layouts.header')
        <!-- Start Search Popup -->
        <div class="box-search-content search_active block-bg close__top">
            <form id="search_mini_form" class="minisearch" action="#">
                <div class="field__search">
                    <input type="text" placeholder="Search entire store here...">
                    <div class="action">
                        <a href="#"><i class="zmdi zmdi-search"></i></a>
                    </div>
                </div>
            </form>
            <div class="close__wrap">
                <span>close</span>
            </div>
        </div>
        <!-- End Search Popup -->
        <!-- Start breadcrumb area -->
        <div class="ht__breadcrumb__area bg-image--6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__inner text-center">
                            <h2 class="breadcrumb-title">My Account</h2>
                            <nav class="breadcrumb-content">
                                <a class="breadcrumb_item" href="index.html">Home</a>
                                <span class="brd-separator">/</span>
                                <span class="breadcrumb_item active">My Account</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End breadcrumb area -->
        <!-- Start My Account Area -->
        <section class="my_account_area pt--80 pb--55 bg--white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="my__account__wrapper">
                            <h3 class="account__title">Login</h3>
                            <form action="#">
                                <div class="account__form">
                                    <div class="input__box">
                                        <label>Username or email address <span>*</span></label>
                                        <input type="text">
                                    </div>
                                    <div class="input__box">
                                        <label>Password<span>*</span></label>
                                        <input type="text">
                                    </div>
                                    <div class="form__btn">
                                        <button>Login</button>
                                        <label class="label-for-checkbox">
                                            <input id="rememberme" class="input-checkbox" name="rememberme"
                                                value="forever" type="checkbox">
                                            <span>Remember me</span>
                                        </label>
                                    </div>
                                    <a class="forget_pass" href="#">Lost your password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="my__account__wrapper">
                            <h3 class="account__title">Register</h3>
                            <form action="#">
                                <div class="account__form">
                                    <div class="input__box">
                                        <label>Email address <span>*</span></label>
                                        <input type="email">
                                    </div>
                                    <div class="input__box">
                                        <label>Password<span>*</span></label>
                                        <input type="password">
                                    </div>
                                    <div class="form__btn">
                                        <button>Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End My Account Area -->

        @include('layouts.footer')

    </div>
    <!-- //Main wrapper -->


    @include('layouts.scripts')
</body>


<!-- Mirrored from htmldemo.net/boighor/boighor/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 05 Aug 2022 23:57:14 GMT -->

</html>
