<li class="app-sidebar__heading"></li>
<li class="{{ Request::is('communities*') ? 'active' : '' }}">
    <a href="{{ route('communities.index') }}">
        <i class="metismenu-icon pe-7s-users"></i>
        <span>@choice('functionalities.communities', 2)</span>
    </a>
</li>

<li class="{{ Request::is('people*') ? 'active' : '' }}">
    <a href="{{ route('people.index') }}">
        <i class="metismenu-icon pe-7s-user"></i>
        <span>@choice('functionalities.people', 2)</span>
    </a>
</li>


