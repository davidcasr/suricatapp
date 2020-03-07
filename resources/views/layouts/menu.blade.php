<li class="app-sidebar__heading"></li>
<li class="{{ Request::is('communities*') ? 'active' : '' }}">
    <a href="{{ route('communities.index') }}" class="mm-active">
        <i class="metismenu-icon pe-7s-users"></i>
        <span>@choice('functionalities.communities', 2)</span>
    </a>
</li>


