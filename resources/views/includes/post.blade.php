@if(isset($topic))
<div class="wrapper" style="background-color: white; padding: 20px; border-radius: 10px; opacity: 0.9 ">
    <div style="color: black">
        <div id="topic">
            <h2><span class="fa fa-sun-o" style="color: orange"></span> Topic of the Day</h2>
            <h4>{{ $topic->title }}</h4>
        </div>

        <div class="comments">
            <h2><span class="fa fa-comments" style="color: royalblue"></span> Comments <span class="badge">{{ $topic->comments()->count() }}</span> </h2>

            @foreach($comments as $comment)
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object" src="@if($comment->user()->first()->avatar) {{$comment->user()->first()->avatar}} @else {{url('/img/dp.png') }} @endif" width="40px" alt="Generic placeholder image">
                    </a>
                </div>

                <div class="media-body">
                    <h4 class="media-heading">{{ $comment->user()->first()->name }}</h4>
                    {{ $comment->comment }}

                    </br>
                    <a href="#"><span class="fa fa-thumbs-up"></span> {{ $comment->likes }}</a>
                    <span>&nbsp;&nbsp;</span>
                    <a href="#"><span class="fa fa-thumbs-down"></span> {{ $comment->dislikes }}</a>
                    @if(Auth::user())
                        @if(Auth::user() == $comment->user()->first() && !Auth::user()->is_admin)
                            <spam>&nbsp;&nbsp;</spam>
                            <a href="{{ url('/topic/comment/delete/'.$comment->id) }}" ><span class="fa fa-trash"></span> Delete Comment</a>
                        @endif

                        @if(Auth::user()->is_admin)
                            </br>
                            <a href="{{ url('/topic/comment/delete/'.$comment->id) }}" class="btn btn-sm btn-warning"><span class="fa fa-trash"></span> Delete Comment</a>
                            @if(!$comment->user()->first()->is_admin)
                                <a href="{{ url('/admin/user/ban/'.$comment->user()->first()->id) }}" class="btn btn-sm btn-danger"><span class="fa fa-ban"></span>@if(Auth::user()->ban == 0) Ban User @else Unban User @endif</a>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
            @endforeach
            
            {{ $comments->links() }}
            
            

            <br>
            @if(Auth::guest())
                <a href="{{ url('/login') }}">Login to post comment</a>
            @elseif(Auth::user()->ban == 1)
                <p style="color: red">You are banned from posting comments. For query email at info@xyz.com</p>
            @else

                <form method="post" action="{{ url('/topic/'.$topic->id.'/comment') }}">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input name="comment" class="form-control" placeholder="Reply to this post">
                        <span class="input-group-btn">
                            <button class="btn btn-success"><span class="fa fa-paper-plane"></span> Submit</button>
                        </span>

                    </div>
                </form>
            @endif

            <br/>
        </div>
    </div>
</div>

@else
    <h2><span class="fa fa-arrow-circle-o-left"></span> Please Add Topic</h2>
@endif