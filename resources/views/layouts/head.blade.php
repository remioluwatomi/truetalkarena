<!doctype html>
<html class="no-js" lang="zxx">

<head prefix="og: https://ogp.me/ns#">
    @isset($blog['blog_title'])
        <!-- ... other tags like title, link, charset, viewport -->
        <meta property="og:title" content="{{ $blog['blog_title'] }}" />
        <meta property="og:description" content="{{ $blog['blog_title'] }}" />
        <meta property="og:image" content="{{ url('/') }}/assets/img/blog/{{ $blog['blog_img'] }}" />
        <meta name="twitter:site" content="@username-truetalkarena" />
        <meta name="twitter:card" content="summary || summary_large_image || player || app" />
        <meta name="twitter:creator" content="@username-truetalkarena" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    @endisset

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>True Talk Arena @if (request()->is('/'))
            - Home
        @else
            - {{ request()->segment(1) }}
        @endif
    </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
    <link rel="shortcut icon" href="/images/icon.png">
    <link rel="apple-touch-icon" href="/images/icon.png">

    <!-- Google font (font-family: 'Roboto', sans-serif; Poppins ; Satisfy) -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,600i,700,700i,800"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/plugins.css?v{{ env('APP_VERSION') }}">
    <link rel="stylesheet" href="/css/style.css?v{{ env('APP_VERSION') }}">
    <link rel="stylesheet" href="/css/finapp.css?v{{ env('APP_VERSION') }}">
    <link rel="stylesheet" href="/css/dark-mode.css?v{{ env('APP_VERSION') }}">

    <link rel="stylesheet" href="/dashboard/assets/vendor/fonts/boxicons.css" />
    <!-- Cusom css -->
    <link rel="stylesheet" href="/css/custom.css?v{{ env('APP_VERSION') }}">

    <!-- Modernizer js -->
    <script src="/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="/magnific-popup/dist/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="/jquery-confirm-v3.3.4/css/jquery-confirm.css" />

    <style>
        .video-image-div {
            position: relative;
        }

        #google_translate_element {
            /* position: fixed;
            bottom: 0;
            left: 0;
            float: left;
            z-index: 9999; */
            overflow: hidden;
        }

        .translated-ltr {
            margin-top: -40px
        }

        .translated-ltr {
            margin-top: -40px
        }

        .goog-te-banner-frame {
            display: none;
            margin-top: -20px
        }

        .goog-logo-link {
            display: none !important;
        }

        .goog-te-gadget {
            color: transparent !important;
        }

        .goog-te-combo {
            border: 1px solid #ddd;
            background-color: #111111;
            color: #b5b5c3;
            box-shadow: -1px 0rem 1rem rgba(51, 51, 51, 0.1);
        }

        .overlay-play {
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            top: 0;
            right: 0;
            left: 0;
            left: 0;
        }

        .overlay-play i {
            font-size: 50px;
            color: #fff
        }

        .image-listview>li a.item:after {
            display: none
        }

        @media only screen and (max-width: 400px) {
            .block-minicart {
                right: -79px;
            }
        }
    </style>
    <link rel="stylesheet" type="text/css" href="/jquery-confirm-v3.3.4/css/jquery-confirm.css" />
</head>
