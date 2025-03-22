@include('layouts.head')

<body>
    <!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
    your browser</a> to improve your experience and security.</p>
<![endif]-->

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
                            <h2 class="breadcrumb-title">Privacy Policy</h2>
                            <nav class="breadcrumb-content">
                                <a class="breadcrumb_item" href="index.html">Home</a>
                                <span class="brd-separator">/</span>
                                <span class="breadcrumb_item active">Privacy Policy</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End breadcrumb area -->
        <!-- Start Portfolio Area -->
        <section class="wn__portfolio__area gallery__masonry__activation bg--white mt--40 pb--100">
            <div class="container-fluid">

                <div class="row masonry__wrap">
                    <div class="col-lg-12">

                        {!! $info['privacy'] !!}
                    </div>
                </div>

            </div>
        </section>
        <!-- End Portfolio Area -->

        @include('layouts.footer')

    </div>
    <!-- //Main wrapper -->

    @include('layouts.scripts')

</body>

</html>
