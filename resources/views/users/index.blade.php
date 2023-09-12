@extends('layouts.app')

@section('content')
    <div class="page user-page">
        <div class="page-container">
                @foreach ($all_users as $user)
                    <div class="user-info">
                            <img src="{{ asset('storage/profile_image/' .$user->profile_image) }}" class="user-icon" >
                            <div class="user-info-name">
                                <p class="user-name">{{ $user->name }}</p>
                                <a href="{{ url('users/' .$user->id) }}" class="user-sceen-name">{{ $user->screen_name }}</a>
                            </div>
                            @if (auth()->user()->isFollowed($user->id))
                                <div class="user-followed">
                                    <span class="followed">フォローされています</span>
                                </div>
                            @endif
                            <div class="user-follow">
                                @if (auth()->user()->isFollowing($user->id))
                                    <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="unfollow button">フォロー解除</button>
                                    </form>
                                @else
                                    <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                                        {{ csrf_field() }}

                                        <button type="submit" class="follow button-black">フォローする</button>
                                    </form>
                                @endif
                            </div>
                    </div>
                @endforeach
            </div>
        {{-- <div class="pagenate">
            {{ $all_users->links() }}
        </div> --}}
    </div>
@endsection

<style scoped>
    .user-page .page-container {
    }

    .user-page .user-info {
    }

    .user-page .user-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        overflow: hidden;
        position: relative;
    }

    .user-page .user-icon img {
        width: 100%;
        height: auto;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
    }

    .user-page .user-info-name {
    }

    .user-page .user-name {
    }

    .user-page .user-screen-name {
    }

    .user-page .user-followed {
    }

    .user-page .followed {
    }

    .user-page .user-follow {
    }

    .user-page .unfollow {
    }

    .user-page .follow {
    }

    .user-page .pagenate {
    }

    .user-page .pagenate {
    }
    

.icon-circle img{
  width: 100%;
  height: auto;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  margin: auto;
}

</style>
