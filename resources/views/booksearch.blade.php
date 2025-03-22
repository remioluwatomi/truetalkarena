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
        <div class="ht__breadcrumb__area bg-image--4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__inner text-center">
                            <h2 class="breadcrumb-title">Search</h2>
                            <nav class="breadcrumb-content">
                                <a class="breadcrumb_item" href="index.html">Home</a>
                                <span class="brd-separator">/</span>
                                <span class="breadcrumb_item active">Search</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End breadcrumb area -->
        <!-- Start Shop Page -->
        <section class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        @if (count($books) > 0)
                            <div class="row">
                                <div class="col-lg-12">
                                    <div
                                        class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">
                                        <div class="shop__list nav justify-content-center" role="tablist">
                                            <a class="nav-item nav-link active" data-bs-toggle="tab" href="#nav-grid"
                                                role="tab"><i class="fa fa-th"></i></a>
                                            <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-list"
                                                role="tab"><i class="fa fa-list"></i></a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab__container tab-content">
                                <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
                                    <div class="row">
                                        @foreach ($books as $key => $item)
                                            <div
                                                class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-xs-6 col-6">
                                                <div class="product__thumb">
                                                    <a class="first__img" href="#productmodal-{{ $item['book_id'] }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#productmodal-{{ $item['book_id'] }}"><img
                                                            src="/assets/img/books/{{ $item['book_cover'] }}"
                                                            alt="product image"></a>
                                                    <a class="second__img animation1"
                                                        href="#productmodal-{{ $item['book_id'] }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#productmodal-{{ $item['book_id'] }}"><img
                                                            src="/assets/img/books/{{ $item['book_back'] }}"
                                                            alt="product image"></a>
                                                    <div class="hot__box">
                                                        <span class="hot-label">sale</span>
                                                    </div>
                                                </div>
                                                <div class="product__content content--center content--center">
                                                    <h4><a href="#productmodal-{{ $item['book_id'] }}"
                                                            data-bs-toggle="modal"
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
                                                                            <input type="number"
                                                                                value="{{ $item['book_id'] }}"
                                                                                name="id">
                                                                            <input type="number"
                                                                                value="{{ $item['book_price'] }}"
                                                                                name="price">
                                                                            <input type="number" value="1"
                                                                                name="quantity">
                                                                            <input type="text"
                                                                                value="/assets/img/books/{{ $item['book_cover'] }}"
                                                                                name="image">
                                                                            <input type="text"
                                                                                value="{{ $item['book_name'] }}"
                                                                                name="name">
                                                                            <button
                                                                                id="addtocartbtn{!! $item['book_id'] !!}"
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
                                    {!! $books->links() !!}
                                </div>
                                <div class="shop-grid tab-pane fade" id="nav-list" role="tabpanel">
                                    <div class="list__view__wrapper">
                                        @foreach ($books as $key => $item)
                                            <!-- Start Single Product -->
                                            <div class="list__view @if ($key > 0) mt--40 @endif">
                                                <div class="thumb">
                                                    <a class="first__img" href="#!"><img
                                                            src="/assets/img/books/{{ $item['book_cover'] }}"
                                                            alt="product image"></a>
                                                    <a class="second__img animation1" href="#!"><img
                                                            src="/assets/img/books/{{ $item['book_back'] }}"
                                                            alt="product image"></a>
                                                </div>
                                                <div class="content">
                                                    <h2><a href="#!">{{ $item['book_name'] }}</a></h2>

                                                    <ul class="price__box">
                                                        <li>&#163;{{ number_format($item['book_price'], 2) }}</li>

                                                    </ul>
                                                    <p>{{ $item['book_desc'] }}</p>
                                                    <ul class="cart__action d-flex">
                                                        <li class="cart">

                                                            <form action="/cart" method="POST">
                                                                @csrf
                                                                <div style="display: none">
                                                                    <input type="number"
                                                                        value="{{ $item['book_id'] }}"
                                                                        name="id">
                                                                    <input type="number"
                                                                        value="{{ $item['book_price'] }}"
                                                                        name="price">
                                                                    <input type="number" value="1"
                                                                        name="quantity">
                                                                    <input type="text"
                                                                        value="/assets/img/books/{{ $item['book_cover'] }}"
                                                                        name="image">
                                                                    <input type="text"
                                                                        value="{{ $item['book_name'] }}"
                                                                        name="name">
                                                                    <button id="addtocart-{!! $item['book_id'] !!}"
                                                                        class="cart" type="submit"><i
                                                                            class="bi bi-shopping-bag4"></i></button>
                                                                </div>
                                                                <div class="addtocart-btn">
                                                                    <a href="#!"
                                                                        onclick="$('#addtocart-{!! $item['book_id'] !!}').trigger('click')">Add
                                                                        to cart</a>
                                                                </div>
                                                            </form>
                                                        </li>
                                                    </ul>

                                                </div>
                                            </div>
                                            <!-- End Single Product -->
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                No Book Found
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- End Shop Page -->

        @include('layouts.footer')

    </div>
    <!-- //Main wrapper -->


    @include('layouts.scripts')
    <script>
        const paginate = $('ul.pagination')
        $('.pagination').addClass('wn__pagination').removeClass('pagination')
        $('.page-item').removeClass('page-item')
        $('.page-link').removeClass('page-link')
        $('.wn__pagination li a.active')
    </script>
</body>


</html>
