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
        <!-- Start breadcrumb area -->
        <div class="ht__breadcrumb__area bg-image--3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__inner text-center">
                            <h2 class="breadcrumb-title">Shopping Cart</h2>
                            <nav class="breadcrumb-content">
                                <a class="breadcrumb_item" href="index.html">Home</a>
                                <span class="brd-separator">/</span>
                                <span class="breadcrumb_item active">Shopping Cart</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End breadcrumb area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area section-padding--lg bg--white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ol-lg-12">

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="table-content wnro__table table-responsive">
                            <table>
                                <thead>
                                    <tr class="title-top">
                                        <th class="product-thumbnail">Image</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        {{-- <th class="product-quantity">Quantity</th> --}}
                                        <th class="product-subtotal">Total</th>
                                        <th class="product-remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($cartItems as $item)
                                        <tr>
                                            <td class="product-thumbnail"><a href="#!"><img
                                                        src="{{ $item->attributes->image }}" alt="product img"></a>
                                            </td>
                                            <td class="product-name">{{ $item->name }}</td>
                                            <td class="product-price"><span
                                                    class="amount">&#163;{{ number_format($item->price, 2) }}</span>
                                            </td>
                                            {{-- <td class="product-quantity"><input type="number" value="1"></td> --}}
                                            <td class="product-subtotal">&#163;{{ number_format($item->price, 2) }}
                                            </td>
                                            <td class="product-remove">
                                                <form action="{{ route('cart.remove') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $item->id }}" name="id">
                                                    {{-- <button class="px-4 py-2 text-white bg-red-600">x</button> --}}
                                                    <button type="submit" id="remove-id-{{ $item->id }}"
                                                        style="display:none"><i class="fa fa-close"></i></button>
                                                    <a href="#!"
                                                        onclick="$('#remove-id-{!! $item->id !!}').trigger('click')">X</a>
                                                </form>
                                        </tr>
                                    @endforeach
                                    {{-- <tr>
                                            <td class="product-thumbnail"><a href="#"><img
                                                        src="images/product/sm-3/3.jpg" alt="product img"></a></td>
                                            <td class="product-name"><a href="#">Vestibulum suscipit</a></td>
                                            <td class="product-price"><span class="amount">$50.00</span></td>
                                            <td class="product-quantity"><input type="number" value="1"></td>
                                            <td class="product-subtotal">$50.00</td>
                                            <td class="product-remove"><a href="#">X</a></td>
                                        </tr> --}}
                                </tbody>
                            </table>
                        </div>
                        <div class="cartbox__btn">
                            <ul
                                class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">

                                <li><a href="/store">Update Cart</a></li>
                                <li><a href="/checkout">Check Out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 offset-lg-6">
                        <div class="cartbox__total__area">
                            <div class="cartbox-total d-flex justify-content-between">
                                <ul class="cart__total__list">
                                    <li>Cart total</li>
                                    <li>Sub Total</li>
                                </ul>
                                <ul class="cart__total__tk">
                                    <li>&#163;{{ number_format(Cart::getTotal(), 2) }}</li>
                                    <li>&#163;{{ number_format(Cart::getTotal(), 2) }}</li>
                                </ul>
                            </div>
                            <div class="cart__total__amount">
                                <span>Grand Total</span>
                                <span>&#163;{{ number_format(Cart::getTotal(), 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart-main-area end -->

        @include('layouts.footer')

    </div>
    <!-- //Main wrapper -->


    @include('layouts.scripts')
</body>


</html>
