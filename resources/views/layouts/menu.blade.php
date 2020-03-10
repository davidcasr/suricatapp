<li class="app-sidebar__heading"></li>

<li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
    <a href="{{ route('dashboard.index') }}">
        <i class="metismenu-icon pe-7s-display1"></i>
        <span>@choice('functionalities.dashboard', 2)</span>
    </a>
</li>

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

<li class="{{ Request::is('groups*') ? 'active' : '' }}">
    <a href="{{ route('groups.index') }}">
        <i class="metismenu-icon pe-7s-graph1"></i>
        <span>@choice('functionalities.groups', 2)</span>
    </a>
</li>

<li class="{{ Request::is('features*') ? 'active' : '' }}">
    <a href="{{ route('features.index') }}">
        <i class="metismenu-icon pe-7s-news-paper"></i>
        <span>@choice('functionalities.features', 2)</span>
    </a>
</li>

<li class="{{ Request::is('profiles*') ? 'active' : '' }}">
    <a href="{{ route('profiles.index') }}">
        <i class="metismenu-icon pe-7s-note"></i>
        <span>@choice('functionalities.profiles', 2)</span>
    </a>
</li>

<li class="{{ Request::is('meetings*') ? 'active' : '' }}">
    <a href="{{ route('meetings.index') }}">
        <i class="metismenu-icon pe-7s-map-2"></i>
        <span>@choice('functionalities.meetings', 2)</span>
    </a>
</li>

<li class="{{ Request::is('meeting_reports*') ? 'active' : '' }}">
    <a href="{{ route('meeting_reports.index') }}">
        <i class="metismenu-icon pe-7s-pin"></i>
        <span>@choice('functionalities.meeting_reports', 2)</span>
    </a>
</li>


