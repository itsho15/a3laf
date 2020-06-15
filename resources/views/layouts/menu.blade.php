
@can('view_users')
<li class="nav-item {{ Request::is('admin/users*') ? 'active' : '' }}">
    <a class="waves-effect waves-dark" href="{!! route('admin.users.index') !!}">
        <i class="nav-icon fa fa-user-circle"></i>
        <span class="hide-menu">@lang('backend.Users')</span>
    </a>
</li>
@endcan

@can('view_roles')
{{-- <li class="nav-item {{ Request::is('admin/roles*') ? 'active' : '' }}">
    <a class="waves-effect waves-dark" href="{!! route('admin.roles.index') !!}">
        <i class="nav-icon fa fa-list"></i>
        <span class="hide-menu">@lang('backend.Roles')</span>
    </a>
</li> --}}
@endcan

@can('view_categories')
<li class="{{ Request::is('admin/categories*') ? 'active' : '' }}">
    <a href="{!! route('admin.categories.index') !!}"><i class="fa fa-edit"></i><span>@lang('backend.Categories')</span></a>
</li>
@endcan

@can('view_countries')
<li class="{{ Request::is('admin/countries*') ? 'active' : '' }}">
    <a href="{{ route('admin.countries.index') }}"><i class="fa fa-edit"></i><span>@lang('models/countries.plural')</span></a>
</li>
@endcan
@can('view_cities')
<li class="{{ Request::is('admin/cities*') ? 'active' : '' }}">
    <a href="{{ route('admin.cities.index') }}"><i class="fa fa-edit"></i><span>@lang('models/cities.plural')</span></a>
</li>
@endcan

@can('view_conversations')
<li class="{{ Request::is('admin/conversations*') ? 'active' : '' }}">
    <a href="{{ route('admin.conversations.index') }}"><i class="fa fa-edit"></i><span>@lang('models/conversations.plural')</span></a>
</li>
@endcan

@can('view_messages')
<li class="{{ Request::is('admin/messages*') ? 'active' : '' }}">
    <a href="{{ route('admin.messages.index') }}"><i class="fa fa-edit"></i><span>@lang('models/messages.plural')</span></a>
</li>
@endcan



<li class="{{ Request::is('admin/types*') ? 'active' : '' }}">
    <a href="{{ route('admin.types.index') }}"><i class="fa fa-edit"></i><span>@lang('models/types.plural')</span></a>
</li>


@can('view_favorite')
<li class="{{ Request::is('admin/favorites*') ? 'active' : '' }}">
    <a href="{{ route('admin.favorites.index') }}"><i class="fa fa-edit"></i><span>@lang('models/favorites.plural')</span></a>
</li>
@endcan

@can('view_ad')
<li class="{{ Request::is('admin/ads*') ? 'active' : '' }}">
    <a href="{{ route('admin.ads.index') }}"><i class="fa fa-edit"></i><span>@lang('models/ads.plural')</span></a>
</li>
@endcan

@can('view_comment')
<li class="{{ Request::is('admin/comments*') ? 'active' : '' }}">
    <a href="{{ route('admin.comments.index') }}"><i class="fa fa-edit"></i><span>@lang('models/comments.plural')</span></a>
</li>
@endcan

@can('view_bank')
<li class="{{ Request::is('admin/banks*') ? 'active' : '' }}">
    <a href="{{ route('admin.banks.index') }}"><i class="fa fa-edit"></i><span>@lang('models/banks.plural')</span></a>
</li>
@endcan

@can('view_account')
<li class="{{ Request::is('admin/accounts*') ? 'active' : '' }}">
    <a href="{{ route('admin.accounts.index') }}"><i class="fa fa-edit"></i><span>@lang('models/accounts.plural')</span></a>
</li>
@endcan

@can('view_follower')
<li class="{{ Request::is('admin/followers*') ? 'active' : '' }}">
    <a href="{{ route('admin.followers.index') }}"><i class="fa fa-edit"></i><span>@lang('models/followers.plural')</span></a>
</li>
@endcan

<li class="nav-item {{ Request::is('admin/settings*') ? 'active' : '' }}">
    <a class="waves-effect waves-dark" href="{!! route('admin.settings.index') !!}">
        <i class="nav-icon fa fa-cog"></i>
        <span class="hide-menu">@lang('models/settings.plural')</span>
    </a>
</li>


