@extends('layouts.app')

@section('content')

<div class="container">
    <div class="post-list">
        <div class="tittle">
            <a href="{{ url('users') }}">ユーザ一覧 <i class="user-list"></i> </a>
        </div>

        @if (isset($timelines))
            @foreach ($timelines as $timeline)
                <div class="post">
                    <div class="card">
                        <div class="post-user">
                            <img src="{{ asset('storage/profile_image/' .$timeline->user->profile_image) }}" class="post-usericon">
                            <div class="post-username">
                                <p class="text">{{ $timeline->user->name }}</p>
                                <a href="{{ url('users/' .$timeline->user->id) }}" class="text">{{ $timeline->user->screen_name }}</a>S
                            </div>
                            <div class="timeline">
                                <p class="text">{{ $timeline->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <div class="content">
                            {!! nl2br(e($timeline->text)) !!}
                        </div>

                        

                        <div class="card-footer">
                            @if ($timeline->user->id === Auth::user()->id)
                                <div class="post-login-user">
                                    <div class="post-menu" >
                                        <a href="{{ url('tweets/' .$timeline->id .'/edit') }}" class="edit-post">編集</a>
                                        <form method="POST" action="{{ url('tweets/' .$timeline->id) }}" class="delete-post"  onclick="deletePost()">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="button">削除</button>
                                        </form>
                                    </div>
                                </div>
                            @endif

                            
                            <div class="comment-item">
                                <a href="{{ url('tweets/' .$timeline->id) }}"><i class="far fa-comment fa-fw"></i></a>
                                <p class="count">{{ count($timeline->comments) }}</p>
                            </div>
                            <div class="fav-item">
                                @if (!in_array($user->id, array_column($timeline->favorites->toArray(), 'user_id'), TRUE))
                                    <form method="POST" action="{{ url('favorites/') }}" class="fav">
                                        @csrf

                                        <input type="hidden" name="tweet_id" value="{{ $timeline->id }}">
                                        <button type="submit" class="button"><i class="far fa-heart fa-fw"></i></button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ url('favorites/' .array_column($timeline->favorites->toArray(), 'id', 'user_id')[$user->id]) }}" class="delete-fav">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="button-black"><i class="fas fa-heart fa-fw"></i></button>
                                    </form>
                                @endif
                                <p class="count">{{ count($timeline->favorites) }}</p>
                            </div>

                            <div class=tags>
                                
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="my-4 d-flex justify-content-center">
        {{ $timelines->links() }}
    </div>
</div>
@endsection

<script>
    function deletePost() {
        if (confirm("削除しますか?")) {
            document.delete.submit();
        }
    }
</script>

