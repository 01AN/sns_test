@extends('layouts.app')

@section('content')
<div class="page">
    <div class="">
        <div class="container">
            <div class="card">
                <div class="card-header">投稿</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tweets.store') }}">
                        @csrf

                        <div class="new-post">
                            <div class="user-info">
                                <img src="{{ asset('storage/profile_image/' .$user->profile_image) }}" class="user-icon" width="50" height="50">
                                <div class="user-info-name">
                                    <p class="user-name">{{ $user->name }}</p>
                                    <a href="{{ url('users/' .$user->id) }}" class="user-screenn-name">{{ $user->screen_name }}</a>
                                </div>
                            </div>
                            <div class="post-text">
                                <textarea class="form-control" name="text" required rows="4">{{ old('text') }}</textarea>

                                @error('text')
                                    <span class="error-message" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">

                            <div class="post-tag">
                                <textarea class="form-control" name="tag">{{ old('tag') }}</textarea>
                            </div>
                        </div>
                            
                        </div>

                        <div class="post-item">
                            <div class="post-content">
                                <p class="info-text">140文字以内</p>
                                <button type="submit" class="button">
                                    投稿する
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
