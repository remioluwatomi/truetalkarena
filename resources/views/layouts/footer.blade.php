<!-- Footer Area -->
<footer id="wn__footer" class="footer__area bg__cat--8 brown--color">
    <div class="footer-static-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__widget footer__menu">
                        <div class="ft__logo">
                            <a href="index.html">
                                <img src="/images/logo/3.png" alt="logo" width="121px">
                            </a>
                            <p>{!! $info['writing'] !!}</p>
                        </div>
                        <div class="footer__content">
                            <ul class="social__net social__net--2 d-flex justify-content-center">
                                @foreach ($socials as $item)
                                    <li><a href="{{ $item['soc_link'] }}"
                                            style="border: 1px solid ;border-radius: 50%;"><i
                                                class="{{ $item['soc_icon'] }}"></i></a>
                                    </li>
                                @endforeach
                            </ul>
                            <ul class="mainmenu d-flex justify-content-center">
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
                                <li><a href="/privacy-policy">Privacy-Policy</a></li>
                            </ul>
                            <div id="google_translate_element">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright__wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="copyright">
                        <div class="copy__right__inner text-start">
                            <p>Made by <a href="https://stilttech.com/" target="_blank">Stilt-tech</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="payment text-end">
                        <img src="/assets/img/flutterwave-logo-vector.svg" alt="flutterwave Logo" width="20%" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- //Footer Area -->
