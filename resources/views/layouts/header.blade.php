@include('layouts.preloader')
<style>
    /* --- Night Mode Btn --- */

    .night_mode_switch__btn {
        border-bottom: 1px solid #efefef;
    }

    .night_mode_switch__btn a {
        display: block;
        font-size: 14px;
        transition: 0.3s;
        font-weight: 500;
        border-radius: 10px;
        color: #333;
        padding: 15px;
        position: relative;
        display: flex;
        align-items: center;
        width: 220px;
    }

    .night_mode_switch__btn a i {
        font-size: 120%;
        height: 30px;
        Width: 30px;
        background: #ffecec;
        border-radius: 100%;
        margin-right: 10px;
        padding: 2px 4px 0;
        display: inline-block;
    }

    .btn-night-mode .btn-night-mode-switch {
        display: inline-block;
        height: 18px;
        width: 37px;
        top: 35%;
        right: 13px;
        position: absolute;
    }
</style>
<!-- Header -->
<header id="wn__header" class="header__area header__absolute sticky__header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-6 col-lg-2">
                <div class="logo">
                    <a href="/">
                        <img src="/images/logo/logo.png" alt="logo images" width="50px">
                    </a>
                </div>
            </div>
            <div class="col-lg-8 d-none d-lg-block">
                <nav class="mainmenu__nav">
                    <ul class="meninmenu d-flex justify-content-start">
                        <li class=""><a href="/">Home</a>
                        </li>
                        <li><a href="/about">About</a>
                        </li>
                        <li><a href="/store">Store</a>
                        </li>
                        <li><a href="/gallery">Gallery</a>
                        </li>

                        <li><a href="/videos">Videos</a>
                        </li>
                        <li><a href="/blog">Blog</a>
                        </li>
                        <li><a href="/contact">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-6 col-sm-6 col-6 col-lg-2">
                <ul class="header__sidebar__right d-flex justify-content-end align-items-center">
                    <li class="shop_search"><a class="search__active" href="#"></a></li>
                    <li class="shopcart"><a class="cartbox_active" href="#"><span
                                class="product_qun">{{ count($cartItems) }}</span></a>
                        <!-- Start Shopping Cart -->
                        <div class="block-minicart minicart__active">
                            <div class="minicart-content-wrapper">
                                <div class="micart__close">
                                    <span>close</span>
                                </div>
                                <div class="items-total d-flex justify-content-between">
                                    <span>{{ count($cartItems) }} items</span>
                                    <span>Cart Subtotal</span>
                                </div>
                                <div class="total_amount text-end">
                                    <span>&#163;{{ number_format(Cart::getTotal(), 2) }}</span>
                                </div>
                                <div class="mini_action checkout">
                                    <a class="checkout__btn" href="/checkout">Go to Checkout</a>
                                </div>
                                <div class="single__items">
                                    <div class="miniproduct">
                                        @foreach ($cartItems as $key => $item)
                                            <div class="item01 d-flex @if ($key > 0) mt--20 @endif">
                                                <div class="thumb">
                                                    <a href="product-details.html"><img
                                                            src="/images/product/sm-img/1.jpg" alt="product images"></a>
                                                </div>
                                                <div class="content">
                                                    <h6><a href="#!">{{ $item->name }}</a></h6>
                                                    <span
                                                        class="price">&#163;{{ number_format($item->price, 2) }}</span>
                                                    <div class="product_price d-flex justify-content-between">
                                                        <span class="qun">Qty: 01</span>
                                                        <ul class="d-flex justify-content-end">

                                                            <li>
                                                                <form action="{{ route('cart.remove') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" value="{{ $item->id }}"
                                                                        name="id">
                                                                    {{-- <button class="px-4 py-2 text-white bg-red-600">x</button> --}}
                                                                    <button type="submit"
                                                                        id="remove-id-btn-{{ $item->id }}"
                                                                        style="display:none"><i
                                                                            class="fa fa-close"></i></button>
                                                                    <a href="#!"
                                                                        onclick="$('#remove-id-btn-{!! $item->id !!}').trigger('click')"><i
                                                                            class="zmdi zmdi-delete"></i></a>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mini_action cart">
                                    <a class="cart__btn" href="/cart">View and edit cart</a>
                                </div>
                            </div>
                        </div>
                        <!-- End Shopping Cart -->
                    </li>
                    <li class="setting__bar__icon"><a class="setting__active" href="#"></a>
                        <div class="searchbar__content setting__block">
                            <div class="content-inner">


                                <div class="switcher-currency">
                                    <strong class="label switcher-label">
                                        <span>My Account</span>
                                    </strong>
                                    <div class="switcher-options">
                                        <div class="switcher-currency-trigger">
                                            <div class="setting__menu">
                                                <ul class="listview image-listview text no-line">
                                                    <li>
                                                        <a class="item" href="#!" onclick="toggleThemeMode()">
                                                            <div class="in">
                                                                <div>
                                                                    Dark Mode
                                                                </div>
                                                                <div class="form-check form-switch  ms-2">
                                                                    <input class="form-check-input dark-mode-switch"
                                                                        type="checkbox"
                                                                        id="modeSwitch"onclick="toggleThemeMode()">
                                                                    <label class="form-check-label"
                                                                        for="modeSwitch"></label>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="/my-books"class="item">

                                                            <div class="in">
                                                                <div>
                                                                    <span>My Account</span>
                                                                </div>
                                                                <div class="form-check form-switch  ms-2">
                                                                    <i class="bx bx-person me-2 text-primary"></i>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                                {{-- <span><a href="#">My Account</a></span> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Start Mobile Menu -->
        <div class="row d-none">
            <div class="col-lg-12 d-none">
                <nav class="mobilemenu__nav">
                    <ul class="meninmenu">
                        <li class=""><a href="/">Home</a>
                        </li>
                        <li><a href="/about">About</a>
                        </li>
                        <li><a href="/store">Store</a>
                        </li>
                        <li><a href="/gallery">Gallery</a>
                        </li>

                        <li><a href="/videos">Videos</a>
                        </li>
                        <li><a href="/blog">Blog</a>
                        </li>
                        <li><a href="/contact">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- End Mobile Menu -->
        <div class="mobile-menu d-block d-lg-none">
        </div>
        <!-- Mobile Menu -->
    </div>
</header>
<!-- //Header -->
