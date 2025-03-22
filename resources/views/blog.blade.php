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
                            <h2 class="breadcrumb-title">Blog Page</h2>
                            <nav class="breadcrumb-content">
                                <a class="breadcrumb_item" href="index.html">Home</a>
                                <span class="brd-separator">/</span>
                                <span class="breadcrumb_item active">Blog</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End breadcrumb area -->
        <!-- Start Blog Area -->
        <div class="page-blog bg--white section-padding--lg blog-sidebar right-sidebar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="blog-page">
                            <div class="page__header">
                                <h2>Blog</h2>
                            </div>

                            @foreach ($blogs as $item)
                                <!-- Start Single Post -->
                                <article class="blog__post d-flex flex-wrap">
                                    <div class="thumb">
                                        <a href="/blog/{{ $item['blog_slug'] }}">
                                            <img src="/assets/img/blog/{{ $item['blog_img'] }}" alt="blog images">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h4><a href="/blog/{{ $item['blog_slug'] }}">{{ $item['blog_title'] }}</a></h4>
                                        <ul class="post__meta">
                                            <li>Posts by : <a href="#">True Talk Arena</a></li>
                                            <li class="post_separator">/</li>
                                            <li>{{ date('j, M Y', strtotime($item['created_at'])) }}</li>
                                        </ul>
                                        <p>{!! substr($item['blog_body'], 0, 50) !!}...</p>
                                        <div class="blog__btn">
                                            <a href="/blog/{{ $item['blog_slug'] }}">read more</a>
                                        </div>
                                    </div>
                                </article>
                                <!-- End Single Post -->
                            @endforeach
                        </div>
                        <div class="wn__pagination">
                            {!! $blogs->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Blog Area -->

        @include('layouts.footer')

    </div>
    <!-- //Main wrapper -->


    @include('layouts.scripts')
</body>


</html>
