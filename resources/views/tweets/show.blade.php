@extends('layouts.app')

@section('content')
<div class="container">
    <div class="">
        <div class="">
            <div class="card">
                <div class="card-haeder">
                    <img src="{{ asset('storage/profile_image/' .$tweet->user->profile_image) }}" class="rounded-circle" width="50" height="50">
                    <div class="post-username">
                        <p class="user-name">{{ $tweet->user->name }}</p>
                        <a href="{{ url('users/' .$tweet->user->id) }}" class="user-screenname">{{ $tweet->user->screen_name }}</a>
                    </div>
                    <div class="timeline">
                        <p class="text">{{ $tweet->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                </div>
                <div class="card-body">
                    {!! nl2br(e($tweet->text)) !!}
                </div>
                <div class="card-footer">
                    @if ($tweet->user->id === Auth::user()->id)
                        <div class="post-login-user">
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <form method="POST" action="{{ url('tweets/' .$tweet->id) }}" class="post-menu">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ url('tweets/' .$tweet->id .'/edit') }}" class="dropdown-item">編集</a>
                                    <button type="submit" class="dropdown-item button">削除</button>
                                </form>
                            </div>
                        </div>
                    @endif
                    <div class="comment-item">
                        <a href="{{ url('tweets/' .$tweet->id) }}"><i class="far fa-comment fa-fw"></i></a>
                        <p class="count-comments">{{ count($tweet->comments) }}</p>
                    </div>

                    <div class="fav-item">
                        @if (!in_array($user->id, array_column($tweet->favorites->toArray(), 'user_id'), TRUE))
                            <form method="POST" action="{{ url('favorites/') }}" class="fav">
                                @csrf

                                <input type="hidden" name="tweet_id" value="{{ $tweet->id }}">
                                <button type="submit" class="button"><i class="far fa-heart fa-fw"></i></button>
                            </form>
                        @else
                            <form method="POST" action="{{ url('favorites/' .array_column($tweet->favorites->toArray(), 'id', 'user_id')[$user->id]) }}" class="delet-fav">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="button-black"><i class="fas fa-heart fa-fw"></i></button>
                            </form>
                        @endif
                        <p class="count-fav">{{ count($tweet->favorites) }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="comment-form">
        <div class="">
            <ul class="list-group">
                @forelse ($comments as $comment)
                    <li class="list-group-item">
                        <div class="comment-item">
                            <img src="{{ asset('storage/profile_image/' .$comment->user->profile_image) }}" class="rounded-circle" width="50" height="50">
                            <div class="com-username">
                                <p class="user-name">{{ $comment->user->name }}</p>
                                <a href="{{ url('users/' .$comment->user->id) }}" class="user-screenname">{{ $comment->user->screen_name }}</a>
                            </div>
                            <div class="timeline">
                                <p class="text">{{ $comment->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <div class="comment-text">
                            {!! nl2br(e($comment->text)) !!}
                        </div>
                    </li>
                @empty
                    <li class="list-group-item">
                        <p class="text">コメントはまだありません。</p>
                    </li>
                @endforelse
                <li class="list-group-item">
                    <div class="py-3">
                        <form method="POST" action="{{ route('comments.store') }}">
                            @csrf

                            <div class="commet-user-item">
                                <div class="comment-user">
                                    <img src="{{ asset('storage/profile_image/' .$user->profile_image) }}" class="rounded-circle" width="50" height="50">
                                    <div class="com-usernname">
                                        <p class="user-name">{{ $user->name }}</p>
                                        <a href="{{ url('users/' .$user->id) }}" class="user-screenname">{{ $user->screen_name }}</a>
                                    </div>
                                </div>
                                <div class="comment-texterea">
                                    <input type="hidden" name="tweet_id" value="{{ $tweet->id }}">
                                    <textarea class="form-control @error('text') is-invalid @enderror" name="text" required autocomplete="text" rows="4">{{ old('text') }}</textarea>

                                    @error('text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="post-item">
                                <div class="">
                                    <p class="text">140文字以内</p>
                                    <button type="submit" class="button">
                                        投稿する
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
