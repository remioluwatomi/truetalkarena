<!-- JS Files -->
<script src="/js/vendor/jquery.min.js"></script>
{{-- <script src="/magnific-popup/libs/jquery/jquery.js"></script> --}}
<script src="/js/popper.min.js"></script>
<script src="/js/vendor/bootstrap.min.js"></script>
<script src="/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="/jquery-confirm-v3.3.4/js/jquery-confirm.js"></script>
<script src="/js/plugins.js?v{{ env('APP_VERSION') }}"></script>
<script src="/js/active.js?v{{ env('APP_VERSION') }}"></script>
<script src="/js/preloader.js?v{{ env('APP_VERSION') }}"></script>

<script src={{ asset('js/element.js') }}></script>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en'
        }, 'google_translate_element');
    }
    const toggleThemeMode = () => {
        if (localStorage.getItem("dark-mode") == "true") {
            localStorage.setItem("dark-mode", "false");
            $("body").removeClass("dark-mode").addClass("light-mode");
            $("#modeSwitch").prop("checked", false);
            // $("#brand-logo").attr(
            //     "src",
            //     "/dashboard/assets/images/logo-icon.png"
            // );
            // $("#brand-logo-mini").attr(
            //     "src",
            //     "/dashboard/assets/images/logo.png"
            // );
            $(".text-light").addClass("text-black").removeClass("text-light");
        } else {
            $("#modeSwitch").prop("checked", true);
            localStorage.setItem("dark-mode", "true");
            $("body").removeClass("light-mode").addClass("dark-mode");
            // $("#brand-logo").attr(
            //     "src",
            //     "/dashboard/assets/images/logo-light.png"
            // );
            // $("#brand-logo-mini").attr(
            //     "src",
            //     "/dashboard/assets/images/logo-white.png"
            // );
            $(".text-black").addClass("text-light").removeClass("text-black");
        }
    };
</script>
