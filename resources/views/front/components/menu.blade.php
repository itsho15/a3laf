<ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/') }}">@lang('front.homepage') <span class="sr-only">(current)</span></a>
    </li>
    @foreach(\App\Models\Page::where('type','menu')->get() as $page)
        <li class="nav-item">
            <a class="nav-link" href="{{ url('pages/'.$page->id.'/'.str_slug($page->slug,'-')) }}">{{ $page->title }}</a>
        </li>
    @endforeach

    @if(!auth()->check())
        <li class="nav-item btn-item">
            <a class="nav-link btn btn-secondary" href="{{ url('login') }}"><i class="far fa-user"></i> @lang('front.login')</a>
        </li>
    @else
        <li class="nav-item dropdown">
            @if(auth()->user()->unReadnotifications->count()> 0)
                <a id="notify" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <span class="fa fa-bell" id="count">
                        {{ auth()->user()->unReadnotifications->count() }}
                    </span>
                </a>
            @endif
            <ul class="dropdown-menu dropdown-menu-right notifications" aria-labelledby="notify">
                @if(auth()->user()->notifications->count() > 0)
                    @foreach(auth()->user()->unReadnotifications()->get() as $notification)
                       @if($notification->type == 'App\Notifications\NewMessage')
                       <li>
                        <a id="notify_mark_as_read" data-id="{{ $notification->id }}" data-conversation_id = {{ $notification['data']['conversation_id']}}>{{ $notification['data']['message'] }}  </a></li>
                       @endif
                    @endforeach
                @else
                    <li>  {{ trans('front.Empty_notification') }} </li>
                @endif
            </ul>

        </li>

        <li class="nav-item dropdown btn-item">
          <a class="nav-link dropdown-toggle btn btn-secondary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i class="far fa-user"></i> @lang('front.myaccount')</a>

            <ul class="dropdown-menu dropdown-menu-right notifications" aria-labelledby="notify">
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ url('edit-profile') }}"> @lang('front.edit-profile')</a>
                </li>

                <li class="dropdown-item">
                    <a class="nav-link" href="{{ url('my-ads') }}"> @lang('front.my-ads')</a>
                </li>

                <li class="dropdown-item">
                    <a class="nav-link" href="{{ url('my-fav') }}"> @lang('front.my-fav')</a>
                </li>

                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    @lang('front.Logout')
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>

        </li>

    @endif

    <li class="nav-item btn-item">
        <a class="nav-link btn btn-primary" href="{{ route('front.ads.create') }}"><i class="fas fa-plus"></i> @lang('front.add_ad')</a>
    </li>
</ul>