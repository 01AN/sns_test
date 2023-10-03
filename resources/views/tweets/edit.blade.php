@extends('layouts.app')

@section('content')
<div class="container">
    <div class="">
        <div class="">
            <div class="card">
                <div class="card-header">投稿編集</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tweets.update', ['tweet' => $tweets]) }}">
                        @csrf
                        @method('PUT')

                        <div class="edit-post">
                            <div class="user-item">
                                <img src="{{ asset('storage/profile_image/' .$user->profile_image) }}" class="rounded-circle" width="50" height="50">
                                <div class="edti-username">
                                    <p class="user-name">{{ $user->name }}</p>
                                    <a href="{{ url('users/' .$user->id) }}" class="user-namescreenname">{{ $user->screen_name }}</a>
                                </div>
                            </div>
                            <div class="edit-text">
                                <textarea class="form-control @error('text') is-invalid @enderror" name="text" required autocomplete="text" rows="4">{{ old('text') ? : $tweets->text }}</textarea>

                                @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="repost">
                            <div class="repost-item">
                                <p class="text">140文字以内</p>
                                <button type="submit" class="button">
                                    ツイートする
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
