@php
if (request()->query('user_name')) {
    // dd(request()->get('user_name'));
    $user_array = ['user_name' => request()->get('user_name'), 'user_email' => request()->get('user_email')];
    session()->put('userData', $user_array);
}
// $testing = ['user_name' => 'onyedika', 'user_email' => 'email@gmail.com'];
// $testing = ['user_name' => request()->get('user_name'), 'user_email' => request()->get('user_email')];

$user = session()->has('userData') ? session()->get('userData') : [];
// dd($user);
$user_name = session()->has('userData') ? $user['user_name'] : '';
$user_email = session()->has('userData') ? $user['user_email'] : '';
$blogComments = [];
$blogCommentNames = [];
$isSigned = session()->has('userData') ? 1 : 0;
foreach ($comments as $val) {
    array_push($blogComments, $val['blog_id']);
}
// dd($blogTopics);
@endphp
@include('layouts.head')

<body>
    <style>
        .input_msg_write input {
            background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
            border: medium none;
            color: #4c4c4c;
            font-size: 15px;
            min-height: 48px;
            width: 100%;
        }

        .type_msg {
            border-top: 1px solid #c4c4c4;
            position: relative;
        }

        .msg_send_btn {
            background: #05728f none repeat scroll 0 0;
            border: medium none;
            border-radius: 50%;
            color: #fff;
            cursor: pointer;
            font-size: 17px;
            height: 33px;
            position: absolute;
            right: 0;
            top: 11px;
            width: 33px;
        }
    </style>
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
                            <h2 class="breadcrumb-title">{{ $blog['blog_title'] }}</h2>
                            <nav class="breadcrumb-content">
                                <a class="breadcrumb_item" href="index.html">Home</a>
                                <span class="brd-separator">/</span>
                                <span class="breadcrumb_item active">Blog-Details</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" value="{{ $isSigned }}" id="isSigned">
        <input type="hidden" value="/blog/{{ $blog['blog_slug'] }}" id="mainPage">
        <!-- End breadcrumb area -->
        <div class="page-blog-details section-padding--lg bg--white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="blog-details content">
                            <article class="blog-post-details">
                                <div class="post-thumbnail">
                                    <img src="/assets/img/blog/{{ $blog['blog_img'] }}" alt="blog images">
                                </div>
                                <div class="post_wrapper">
                                    <div class="post_header">
                                        <h2>{{ $blog['blog_title'] }}</h2>
                                        <div class="blog-date-categori">
                                            <ul>
                                                <li>{{ date('j, M Y', strtotime($blog['created_at'])) }}</li>
                                                <li><a href="#" title="Posts by true talk arena"
                                                        rel="author">True Talk Arena</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="post_content">
                                        {!! $blog['blog_body'] !!}
                                    </div>

                                </div>
                            </article>
                            @include('layouts.comment')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')

    </div>
    <!-- //Main wrapper -->

    <div class="modal fade" id="replyModal" tabIndex="-1" data-bs-backdrop="static" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true" style="backdrop-filter: blur(5px)">
        <div class="modal-dialog " role="document">
            <div class="modal-content glass-panel">
                <div class="modal-header">
                    <h5 class="modal-title">
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="replyform" method="post">
                        <p class="comment-form-author">
                            <input type="hidden" name="comment_id" id="comment_id" size="30" required="required">
                            <input type="hidden" name="reply_to" id="reply_to" size="30" required="required">
                        </p>
                        <div class="row">

                            <div class="col-4">
                                <p class="comment-form-author">
                                    <input type="text" name="user_name" class="form-control form-control-sm"
                                        placeholder="Name" value="{{ $user_name }}" size="30"
                                        required="required">
                                </p>
                            </div>
                            <div class="col-4">
                                <p class="comment-form-email">
                                    <input type="email" name="user_email" class="form-control form-control-sm"
                                        placeholder="Email" value="{{ $user_email }}" aria-required="true"
                                        required="required">
                                </p>
                            </div>
                        </div>
                        <div class="type_msg">
                            <div class="input_msg_write">
                                <input type="text" class="write_msg" placeholder="Type in reply" name="reply"
                                    required="required" />
                                <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane"
                                        aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.scripts')
    <script src="/js/form.js?v={{ env('APP_VERSION') }}"></script>
</body>

</html>
