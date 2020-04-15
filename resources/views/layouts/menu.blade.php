<li class="app-sidebar__heading"></li>

@can('dashboard')
    <li class="{{ Request::is('dashboard*') ? 'mm-active' : '' }}">
        <a href="{{ route('dashboard.index') }}">
            <i class="metismenu-icon pe-7s-display1"></i>
            <span>@choice('functionalities.dashboard', 2)</span>
        </a>
    </li>
@endcan

@can('communities')
    <li class="{{ Request::is('communities*') ? 'mm-active' : '' }}">
        <a href="{{ route('communities.index') }}">
            <i class="metismenu-icon pe-7s-users"></i>
            <span>@choice('functionalities.communities', 2)</span>
        </a>
    </li>
@endcan

<li>
    @can('people')
        <a href="#">
            <i class="metismenu-icon pe-7s-user"></i>
                @choice('functionalities.people', 2)
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>
    @endcan
    <ul>
        @can('people')
            <li class="{{ Request::is('people*') ? 'mm-active' : '' }}">
                <a href="{{ route('people.index') }}">
                    <i class="metismenu-icon pe-7s-user"></i>
                    <span>@choice('functionalities.people', 2)</span>
                </a>
            </li>
        @endcan

        @can('features')
            <li class="{{ Request::is('features*') ? 'mm-active' : '' }}">
                <a href="{{ route('features.index') }}">
                    <i class="metismenu-icon pe-7s-news-paper"></i>
                    <span>@choice('functionalities.features', 2)</span>
                </a>
            </li>
        @endcan
    </ul>
</li>

<li>
    @can('groups')
        <a href="#">
            <i class="metismenu-icon pe-7s-graph1"></i>
                @choice('functionalities.groups', 2)
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>
    @endcan
    <ul>
        @can('groups')
            <li class="{{ Request::is('groups*') ? 'mm-active' : '' }}">
                <a href="{{ route('groups.index') }}">
                    <i class="metismenu-icon pe-7s-graph1"></i>
                    <span>@choice('functionalities.groups', 2)</span>
                </a>
            </li>
        @endcan
        @can('profiles')
            <li class="{{ Request::is('profiles*') ? 'mm-active' : '' }}">
                <a href="{{ route('profiles.index') }}">
                    <i class="metismenu-icon pe-7s-note"></i>
                    <span>@choice('functionalities.profiles', 2)</span>
                </a>
            </li>
        @endcan
    </ul>
</li>

<li>
    @can('meetings')
        <a href="#">
            <i class="metismenu-icon pe-7s-map-2"></i>
                <span>@choice('functionalities.meetings', 2)
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>
    @endcan
    <ul>
        @can('meetings')
            <li class="{{ Request::is('meetings*') ? 'mm-active' : '' }}">
                <a href="{{ route('meetings.index') }}">
                    <i class="metismenu-icon pe-7s-map-2"></i>
                    <span>@choice('functionalities.meetings', 2)</span>
                </a>
            </li>
        @endcan

        @can('assistants')
            <li class="{{ Request::is('assistants*') ? 'mm-active' : '' }}">
                <a href="{{ route('assistants.index') }}">
                    <i class="metismenu-icon pe-7s-add-user"></i>
                    <span>@choice('functionalities.assistants', 2)</span>
                </a>
            </li>
        @endcan    
    </ul>
</li>


<li>
    @can('meeting_reports')
        <a href="#">
            <i class="metismenu-icon pe-7s-note2"></i>
                <span>@choice('functionalities.reports', 2)
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>
    @endcan
    <ul>
        @can('meeting_reports')
            <li class="{{ Request::is('meetingReports*') ? 'mm-active' : '' }}">
                <a href="{{ route('meetingReports.index') }}">
                    <i class="metismenu-icon pe-7s-pin"></i>
                    <span>@choice('functionalities.meeting_reports', 2)</span>
                </a>
            </li>
        @endcan
    </ul>
</li>


