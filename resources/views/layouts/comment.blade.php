<div class="comments_area">
    <h3 class="comment__title">{{ count(array_keys($blogComments, $blog['blog_id'])) }} comment</h3>

    @foreach ($comments as $key => $item)
        @php
            $replies = new App\Http\Controllers\ReplyController();
            $replies = $replies->showByComment($item['comment_id']);
            // dd($replies);
        @endphp
        <ul class="comment__list" id="comment-{{ $key + 1 }}">
            <li>
                <div class="wn__comment">
                    <div class="thumb">
                        <img src="/images/blog/comment/1.jpg" alt="{{ $item['user_name'] }}">
                    </div>
                    <div class="content">
                        <div class="comnt__author d-block d-sm-flex">
                            <span><a href="#">{{ $item['user_name'] }}</a> </span>
                            <span>{{ date('M j, Y', strtotime($item['created_at'])) }}
                                at {{ date('h:i:sa', strtotime($item['created_at'])) }}</span>
                            <div class="reply__btn">
                                <a href="#!"data-bs-toggle="modal" data-bs-target="#replyModal"
                                    onclick="$('#comment_id').val({{ $item['comment_id'] }});
                                $('#reply_to').val('{{ $item['user_name'] }}')">Reply</a>
                            </div>
                        </div>
                        <p>{{ $item['comment'] }}</p>
                    </div>
                </div>
            </li>
            @foreach ($replies as $key => $reply)
                <li class="comment_reply"id="comment-reply-{{ $key + 1 }}">
                    <div class="wn__comment">
                        <div class="thumb">
                            <img src="/images/blog/comment/1.jpg" alt="comment images">
                        </div>
                        <div class="content">
                            <div class="comnt__author d-block d-sm-flex">
                                <span><a href="#">{{ $reply['user_name'] }}</a> </span>
                                <span>{{ date('M j, Y', strtotime($item['created_at'])) }}
                                    at {{ date('h:i:sa', strtotime($item['created_at'])) }}</span>
                                <div class="reply__btn">
                                    <a href="#!" class="reply" data-bs-toggle="modal" data-bs-target="#replyModal"
                                        onclick="$('#comment_id').val({{ $item['comment_id'] }});
                                $('#reply_to').val('{{ $reply['user_name'] }}')">Reply</a>
                                </div>
                            </div>
                            <p><b> {{ '@' }}{{ $reply['reply_to'] }}</b>
                                {{ $reply['reply'] }}</p>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endforeach
</div>
<div class="comment_respond">
    <h3 class="reply_title">Leave a Reply <small></small></h3>
    <form class="comment__form" action="#" id="comment-form">
        <p>Your email address will not be published.Required fields are marked </p>
        <div class="input__box">
            <textarea name="comment" placeholder="Your comment here" required></textarea>
        </div>
        <input type="hidden" name="blog_id" value="{{ $blog['blog_id'] }}">

        <div class="input__wrapper clearfix" @if (session()->has('user')) style="display:none;" @endif>
            <div class="input__box name one--third">
                <input type="text" placeholder="name" name="user_name" value="{{ $user_name }}" required>
            </div>
            <div class="input__box email one--third">
                <input type="email" placeholder="email" name="user_email" value="{{ $user_email }}" required>
            </div>
        </div>
        <input type="submit" id="submit-btn" style="display: none">
        <div class="submite__btn">
            <a href="#!" for="submit-btn" onclick="$('#submit-btn').trigger('click')">Post Comment</a>
        </div>
    </form>
</div>
