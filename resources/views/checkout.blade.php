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
                            <h2 class="breadcrumb-title">Checkout</h2>
                            <nav class="breadcrumb-content">
                                <a class="breadcrumb_item" href="index.html">Home</a>
                                <span class="brd-separator">/</span>
                                <span class="breadcrumb_item active">Checkout</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End breadcrumb area -->
        <!-- Start Checkout Area -->
        <section class="wn__checkout__area section-padding--lg bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="wn_checkout_wrap">
                            <div class="checkout_info">
                                <span>Returning customer ?</span>
                                <a class="showlogin" href="#">Click here to login</a>
                            </div>
                            <div class="checkout_login" style="display: block">
                                <div class="wn__checkout__form" action="#">

                                    <div class="input__box">
                                        <label>Firstname <span>*</span></label>
                                        <input type="text" id="name" value="{{ session('user')->firstname }}"
                                            readonly>
                                    </div>
                                    <div class="input__box">
                                        <label>Lastname <span>*</span></label>
                                        <input type="text" value="{{ session('user')->lastname }}" readonly>
                                    </div>
                                    <div class="input__box">
                                        <label>Username or email <span>*</span></label>
                                        <input type="text" id="email" value="{{ session('user')->email }}"
                                            readonly>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-6 col-12 md-mt-40 sm-mt-40">
                        <div class="wn__order__box">
                            <h3 class="order__title">Your order</h3>
                            <ul class="order__total">
                                <li>Product</li>
                                <li>Total</li>
                            </ul>
                            <ul class="order_product">
                                @foreach ($cartItems as $item)
                                    <li>{{ $item->name }}<span>&#163;{{ number_format($item->price, 2) }}</span></li>
                                @endforeach
                            </ul>
                            <ul class="shipping__method">
                                <li>Cart Subtotal <span>&#163;{{ number_format(Cart::getTotal(), 2) }}</span></li>

                            </ul>
                            <ul class="total__amount">
                                <li>Order Total <span>&#163;{{ number_format(Cart::getTotal(), 2) }}</span></li>
                            </ul>
                        </div>
                        <div id="accordion" class="checkout_accordion mt--30" role="tablist">

                            <div class="payment">
                                <div class="che__header" role="tab" id="headingFour">
                                    <a class="collapsed checkout__title" data-bs-toggle="collapse" href="#collapseFour"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        <span><span>Flutterwave</span>
                                            <img src="/assets/img/flutterwave-logo-vector.svg" alt="flutterwave Logo"
                                                width="20%"> </span>
                                    </a>
                                </div>
                                <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour"
                                    data-bs-parent="#accordion">
                                    <div class="payment-body">

                                        {{-- <form action="/proceedPaymemt" method="POST"> --}}
                                        @csrf
                                        <input type="hidden" value="{{ session('user')->id }}" id="user_id">
                                        <input type="hidden" value="{{ url('/') }}/payment/redirect"
                                            id="redirect">
                                        <input type="hidden" value="{{ number_format(Cart::getTotal(), 2) }}"
                                            id="totalAmount">

                                        <div class="top-area">
                                            <div class="p-msg">Pay via flutterwave you can pay
                                                with your credit card.</div>
                                        </div>
                                        <div class="form-group basic">
                                            <center><button type="submit" onclick="makePayment()"
                                                    class="btn btn-primary btn-block btn-lg">Proceed</button>
                                            </center>
                                        </div>
                                        {{-- </form> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- End Checkout Area -->
        <script>
            const cartItems = {!! $cartItems !!}
        </script>
        @include('layouts.footer')

    </div>
    <!-- //Main wrapper -->


    @include('layouts.scripts')
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <script src="/js/checkout.js"></script>
</body>



</html>
