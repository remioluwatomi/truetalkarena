@php
function getvideolink($uri)
{
    $videoId = str_replace('https://www.youtube.com/watch?v=', '', $uri);
    // var videoId = str.replace("https://www.youtube.com/watch?v=", "");
    $result = "http://img.youtube.com/vi/$videoId/0.jpg";
    return $result;
}
@endphp
@include('layouts.head')

<body>
    <style>
        .bg-glass {
            background-color: rgba(255, 255, 255, 0.534);
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }

        #main-slider .slider__content,
        #main-slider .container {
            z-index: 2;
        }
    </style>
    <!-- Main wrapper -->
    <div class="wrapper" id="wrapper">
        @include('layouts.header')
        <!-- Start Search Popup -->
        <div class="brown--color box-search-content search_active block-bg close__top">
            <form id="search_mini_form" class="minisearch" action="/store-search">
                <div class="field__search">
                    <input type="text" name="book" placeholder="Search entire store here...">
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
        <!-- Start Slider area -->
        <div class="slider-area brown__nav slider--15 slide__activation slide__arrow01 owl-carousel owl-theme"
            id="main-slider">
            <!-- Start Single Slide -->
            <div class="slide animation__style10 bg-image--10 fullscreen align__center--left">
                <div class="bg-glass"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="slider__content">
                                <div class="contentbox">
                                    <h3>True Talk Arena</h3>
                                    <h2>Prolific Writer</h2>
                                    <p>We write to impact knowledge </p>
                                    <a class="shopbtn" href="/store">shop now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Single Slide -->
            <!-- Start Single Slide -->
            <div class="slide animation__style10 bg-image--9 fullscreen align__center--left">
                <div class="bg-glass"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="slider__content">
                                <div class="contentbox">
                                    <h3>True Talk Arena</h3>
                                    <h2>Motivational Speaker</h2>
                                    <p>We speak to impact knowledge </p>
                                    <a class="shopbtn" href="/store">shop now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Single Slide -->
            <!-- Start Single Slide -->
            <div class="slide animation__style10 bg-image--8 fullscreen align__center--left">
                <div class="bg-glass"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="slider__content">
                                <div class="contentbox">
                                    <h3>True Talk Arena</h3>
                                    <h2>Content Creator</h2>
                                    <p>We create content to change people's mindset. </p>
                                    <a class="shopbtn" href="/store">shop now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Single Slide -->

            <!-- Start Single Slide -->
            <div class="slide animation__style10 bg-image--7 fullscreen align__center--left">
                <div class="bg-glass"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="slider__content">
                                <div class="contentbox">
                                    <h3>True Talk Arena</h3>
                                    <h2>Brand Influencer</h2>
                                    <p>We Influence</p>
                                    {{-- <a class="shopbtn" href="/store">shop now</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Single Slide -->
        </div>
        <!-- End Slider area -->
        <!-- Start Testimonial Area -->
        <section class="wn__testimonial__area  ptb--80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="testimonial__container text-center" id="intro-video">
                            <img src="{{ getvideolink($info['intro video']) }}" class="img-fluid rounded-start"
                                alt="intro video"> <a class="overlay-play popup-videos"
                                href="{{ $info['intro video'] }}}"><i class=" tf-icons bx bx-play-circle"></i><a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Testimonial Area -->
        <!-- Start BEst Seller Area -->
        <section class="wn__product__area brown--color pt--80  pb--30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__title text-center">
                            <h2 class="title__be--2"> <span class="color--theme">Adverts</span></h2>
                        </div>
                    </div>
                </div>
                <!-- Start Single Tab Content -->
                <div class="furniture--4 border--round arrows_style owl-carousel owl-theme mt--50">
                    @foreach ($adverts as $item)
                        <!-- Start Single Product -->
                        <div class="product product__style--3">
                            <div class="product__thumb">
                                <a class="first__img" href="{{ $item['advert_url'] }}" target="_blank"><img
                                        src="/assets/img/adverts/{{ $item['advert_img'] }}" alt="product image"></a>
                                <a class="second__img animation1" href="{{ $item['advert_url'] }}" target="_blank"><img
                                        src="/assets/img/adverts/{{ $item['advert_img'] }}" alt="product image"></a>
                                <div class="hot__box">
                                    <span class="hot-label">Sponsored</span>
                                </div>
                            </div>
                            <div class="product__content content--center">
                                <h4><a href="{{ $item['advert_url'] }}" target="_blank">{{ $item['advert_title'] }}</a>
                                </h4>
                                <div class="price d-flex">
                                    <p>{{ $item['advert_desc'] }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Start Single Product -->
                    @endforeach
                </div>
                <!-- End Single Tab Content -->
            </div>
        </section>
        <!-- Start BEst Seller Area -->
        <!-- Start Best Seller Area -->
        <section class="wn__bestseller__area bg--white pt--80  pb--30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__title text-center">
                            <h2 class="title__be--2">My <span class="color--theme">Books</span></h2>
                        </div>
                    </div>
                </div>
                <div class="product__indicator--4 arrows_style owl-carousel owl-theme">
                    @foreach ($books as $key => $item)
                        <div class="single__product">
                            <!-- Start Single Product -->
                            <div class="single__product__inner">
                                <div class="product product__style--3">
                                    <div class="product__thumb">
                                        <a class="first__img" href="#productmodal-{{ $item['book_id'] }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#productmodal-{{ $item['book_id'] }}"><img
                                                src="/assets/img/books/{{ $item['book_cover'] }}"
                                                alt="product image"></a>
                                        <a class="second__img animation1" href="#productmodal-{{ $item['book_id'] }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#productmodal-{{ $item['book_id'] }}"><img
                                                src="/assets/img/books/{{ $item['book_back'] }}"
                                                alt="product image"></a>
                                        <div class="hot__box">
                                            <span class="hot-label">sale</span>
                                        </div>
                                    </div>
                                    <div class="product__content content--center content--center">
                                        <h4><a href="#productmodal-{{ $item['book_id'] }}" data-bs-toggle="modal"
                                                data-bs-target="#productmodal-{{ $item['book_id'] }}">{{ $item['book_name'] }}</a>
                                        </h4>
                                        <ul class="price d-flex">
                                            <li>&#163;{{ number_format($item['book_price'], 2) }}</li>
                                        </ul>
                                        <div class="action">
                                            <div class="actions_inner">
                                                <ul class="add_to_links">
                                                    <li>
                                                        <form action="/cart" method="POST">
                                                            @csrf
                                                            <div style="display: none">
                                                                <input type="number" value="{{ $item['book_id'] }}"
                                                                    name="id">
                                                                <input type="number"
                                                                    value="{{ $item['book_price'] }}" name="price">
                                                                <input type="number" value="1" name="quantity">
                                                                <input type="text"
                                                                    value="/assets/img/books/{{ $item['book_cover'] }}"
                                                                    name="image">
                                                                <input type="text"
                                                                    value="{{ $item['book_name'] }}" name="name">
                                                                <button id="addtocartbutton{!! $item['book_id'] !!}"
                                                                    class="cart" type="submit"><i
                                                                        class="bi bi-shopping-bag4"></i></button>
                                                            </div>
                                                            <a class="cart" href="#!"
                                                                onclick="$('#addtocartbutton{!! $item['book_id'] !!}').trigger('click')"><i
                                                                    class="bi bi-shopping-bag4"></i></a>
                                                        </form>
                                                    </li>
                                                    <li><a data-bs-toggle="modal" title="Quick View"
                                                            class="quickview modal-view detail-link"
                                                            href="#productmodal-{{ $item['book_id'] }}"><i
                                                                class="bi bi-search"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Single Product -->
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    @foreach ($books as $key => $item)
                        <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-xs-6 col-6">
                            <div class="product__thumb">
                                <a class="first__img" href="#productmodal-{{ $item['book_id'] }}"
                                    data-bs-toggle="modal" data-bs-target="#productmodal-{{ $item['book_id'] }}"><img
                                        src="/assets/img/books/{{ $item['book_cover'] }}" alt="product image"></a>
                                <a class="second__img animation1" href="#productmodal-{{ $item['book_id'] }}"
                                    data-bs-toggle="modal" data-bs-target="#productmodal-{{ $item['book_id'] }}"><img
                                        src="/assets/img/books/{{ $item['book_back'] }}" alt="product image"></a>
                                <div class="hot__box">
                                    <span class="hot-label">sale</span>
                                </div>
                            </div>
                            <div class="product__content content--center content--center">
                                <h4><a href="#productmodal-{{ $item['book_id'] }}" data-bs-toggle="modal"
                                        data-bs-target="#productmodal-{{ $item['book_id'] }}">{{ $item['book_name'] }}</a>
                                </h4>
                                <ul class="price d-flex">
                                    <li>&#163;{{ number_format($item['book_price'], 2) }}</li>
                                </ul>
                                <div class="action">
                                    <div class="actions_inner">
                                        <ul class="add_to_links">
                                            <li>
                                                <form action="/cart" method="POST">
                                                    @csrf
                                                    <div style="display: none">
                                                        <input type="number" value="{{ $item['book_id'] }}"
                                                            name="id">
                                                        <input type="number" value="{{ $item['book_price'] }}"
                                                            name="price">
                                                        <input type="number" value="1" name="quantity">
                                                        <input type="text"
                                                            value="/assets/img/books/{{ $item['book_cover'] }}"
                                                            name="image">
                                                        <input type="text" value="{{ $item['book_name'] }}"
                                                            name="name">
                                                        <button id="addtocartbtn{!! $item['book_id'] !!}"
                                                            class="cart" type="submit"><i
                                                                class="bi bi-shopping-bag4"></i></button>
                                                    </div>
                                                    <a class="cart" href="#!"
                                                        onclick="$('#addtocartbtn{!! $item['book_id'] !!}').trigger('click')"><i
                                                            class="bi bi-shopping-bag4"></i></a>
                                                </form>
                                            </li>
                                            <li><a data-bs-toggle="modal" title="Quick View"
                                                    class="quickview modal-view detail-link"
                                                    href="#productmodal-{{ $item['book_id'] }}"><i
                                                        class="bi bi-search"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Start BEst Seller Area -->
        <!-- Start Recent Post Area -->
        <section class="wn__recent__post style-two ptb--80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__title text-center">
                            <h2 class="title__be--2">Our <span class="color--theme">Blog</span></h2>

                        </div>
                    </div>
                </div>
                <div class="row mt--50">
                    @foreach ($blogs as $key => $item)
                        @if ($key < 3)
                            <div class="col-md-6 col-lg-4 col-sm-12">
                                <div class="post__itam">
                                    <div class="content">
                                        <h3><a href="/blog/{{ $item['blog_slug'] }}">{{ $item['blog_title'] }} </a>
                                        </h3>
                                        <p>{!! substr($item['blog_body'], 0, 50) !!}...</p>
                                        <div class="post__time">
                                            <span
                                                class="day">{{ date('j, M Y', strtotime($item['created_at'])) }}</span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </section>
        <!-- End Recent Post Area -->
        @include('layouts.footer')

        <!-- QUICKVIEW PRODUCT -->
        <div id="quickview-wrapper">
            <!-- Modal -->
            @foreach ($books as $key => $item)
                <div class="modal fade" id="productmodal-{{ $item['book_id'] }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal__container" role="document">
                        <div class="modal-content">
                            <div class="modal-header modal__header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-product">
                                    <!-- Start product images -->
                                    <div class="product-images">
                                        <div class="main-image images">
                                            <img alt="big images" src="/assets/img/books/{{ $item['book_cover'] }}">
                                        </div>
                                    </div>
                                    <!-- end product images -->
                                    <div class="product-info">
                                        <h1>{{ $item['book_name'] }}</h1>
                                        <div class="price-box-3">
                                            <div class="s-price-box">
                                                <span
                                                    class="new-price">&#163;{{ number_format($item['book_price'], 2) }}</span>
                                            </div>
                                        </div>
                                        <div class="quick-desc">
                                            {{ $item['book_desc'] }}
                                        </div>
                                        <form action="/cart" method="POST">
                                            @csrf
                                            <div style="display: none">
                                                <input type="number" value="{{ $item['book_id'] }}" name="id">
                                                <input type="number" value="{{ $item['book_price'] }}"
                                                    name="price">
                                                <input type="number" value="1" name="quantity">
                                                <input type="text"
                                                    value="/assets/img/books/{{ $item['book_cover'] }}"
                                                    name="image">
                                                <input type="text" value="{{ $item['book_name'] }}"
                                                    name="name">
                                                <button id="addtocart{!! $item['book_id'] !!}" class="cart"
                                                    type="submit"><i class="bi bi-shopping-bag4"></i></button>
                                            </div>
                                            <div class="addtocart-btn">
                                                <a href="#!"
                                                    onclick="$('#addtocart{!! $item['book_id'] !!}').trigger('click')">Add
                                                    to cart</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <!-- END QUICKVIEW PRODUCT -->
    </div>
    <!-- //Main wrapper -->

    @include('layouts.scripts')
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
