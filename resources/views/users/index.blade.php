@extends('layouts.app')

@section('content')
    <div class="page page-user">
        <div class="page-container">
            <div class="post-list">
                @foreach ($all_users as $user)
                    <div class="post">
                            <img src="{{ asset('storage/profile_image/' .$user->profile_image) }}" class="image-icon">
                            <div class="user">
                                <p class="user-name">{{ $user->name }}</p>
                                <a href="{{ url('users/' .$user->id) }}" class="user-name">{{ $user->screen_name }}</a>
                            </div>
                            @if (auth()->user()->isFollowed($user->id))
                                <div class="px-2">
                                    <span class="followed">フォローされています</span>
                                </div>
                            @endif
                            <div class="follow">
                                @if (auth()->user()->isFollowing($user->id))
                                    <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="button">フォロー解除</button>
                                    </form>
                                @else
                                    <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                                        {{ csrf_field() }}

                                        <button type="submit" class="button-black">フォローする</button>
                                    </form>
                                @endif
                            </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="my-4 d-flex justify-content-center">
            {{ $all_users->links() }}
        </div>
    </div>
@endsection

<style scoped>
    .user-page .page-container {
        padding: 0 10px;
    }

    .user-page .user-info .user-icon {
        width: 60px;
        height: 60px;
    }

    .user-page .user-info {
        margin-bottom: 10px;
    }

    .user-page .user-row {
        display: flex;
        justify-content: space-between;
        line-height: 60px;
    }

    .user-page .user-info .user-name {
        font-size: 20px;
        font-weight: bold;
    }

    .user-page .biography {
        font-size: 14px;
        padding: 8px 0;
    }

    .user-page .follow-info {
        display: flex;
        font-size: 14px;
    }

    .user-page .follow-info .follow {
        margin-right: 5px;
    }

    .user-page .title {
        font-size: 18px;
        font-weight: bold;
        color: gray;
        margin-bottom: 6px;
    }

    .user-page .post {
        display: flex;
        padding: 0 10px;
    }

    .user-page .post .container {
        width: 90%;
    }

    .user-page .post-list .user-icon {
        width: 40px;
        height: 40px;
    }

    .user-page .user-name {
        line-height: 40px;
    }

    .user-page .content {
        font-size: 14px;
        word-wrap: break-word;
    }

    .user-page .time-stamp {
        font-size: 8px;
        text-align: end;
    }
</style>
