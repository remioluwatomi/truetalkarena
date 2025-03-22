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
        <div class="ht__breadcrumb__area bg-image--3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__inner text-center">
                            <h2 class="breadcrumb-title">About us</h2>
                            <nav class="breadcrumb-content">
                                <a class="breadcrumb_item" href="index.html">Home</a>
                                <span class="brd-separator">/</span>
                                <span class="breadcrumb_item active">About us</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End breadcrumb area -->
        <!-- Start About Area -->
        <div class="page-about about_area bg--white section-padding--lg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__title--3 text-center pb--30">
                            <h2>True Talk Arena</h2>
                            {{-- <p>the right people for your project</p> --}}
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-6 col-sm-12 col-12">
                        <div class="content text-start text_style--2">
                            <img src="/images/bg/about.jpg?v={{ env('APP_VERSION') }}" alt="About" width="100%">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-12">
                        <div class="content">
                            <p class="mt--20 mb--20">{{ $info['about'] }}</p>
                            <strong>Why watch my videos?</strong>
                            <p>{{ $info['mission'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End About Area -->

        <section class="wn__portfolio__area gallery__masonry__activation bg--white mt--40 pb--100">
            <div class="container-fluid">

                <div class="row masonry__wrap">
                    @foreach ($gallery as $item)
                        <!-- Start Single Portfolio -->
                        <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-12 gallery__item ">
                            <div class="portfolio">
                                <div class="thumb">
                                    <a href="#!">
                                        <img src="/assets/img/gallery/{{ $item['image'] }}" alt="portfolio images">
                                    </a>
                                    <div class="search">
                                        <a href="/assets/img/gallery/{{ $item['image'] }}" data-lightbox="grportimg"
                                            data-title="My caption"><i class="zmdi zmdi-search"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Portfolio -->
                    @endforeach
                </div>
            </div>
        </section>

        @include('layouts.footer')

    </div>
    <!-- //Main wrapper -->


    @include('layouts.scripts')
</body>


</html>
