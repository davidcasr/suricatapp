@can('super_all')

<li class="app-sidebar__heading">@choice('functionalities.menu_admin.administration', 2)</li>

<li class="{{ Request::is('admin/admin_dashboard*') ? 'mm-active' : '' }}">
    <a href="{{ route('admin_dashboard.index') }}">
        <i class="metismenu-icon pe-7s-display1"></i>
        <span>@choice('functionalities.dashboard', 2)</span>
    </a>
</li>

<li>
    <a href="#">
        <i class="metismenu-icon pe-7s-users icon-gradient bg-premium-dark"></i>
        {{ __('functionalities.menu_admin.user_management') }}
        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
    </a>
    <ul>
        <li class="{{ Request::is('admin/users*') ? 'mm-active' : '' }}">
            <a href="{!! route('users.index') !!}">
                <i class="metismenu-icon"></i>
                <span>@choice('functionalities.users', 2)</span>
            </a>
        </li>
        <li class="{{ Request::is('admin/roles*') ? 'mm-active' : '' }}">
            <a href="{!! route('roles.index') !!}">
                <i class="metismenu-icon"></i>
                <span>@choice('functionalities.roles', 2)</span>
            </a>
        </li>
        <li class="{{ Request::is('admin/abilities*') ? 'mm-active' : '' }}">
            <a href="{!! route('abilities.index') !!}">
                <i class="metismenu-icon"></i>
                <span>@choice('functionalities.abilities', 2)</span>
            </a>
        </li>
    </ul>
</li>

<li>
    <a href="#">
        <i class="metismenu-icon pe-7s-tools icon-gradient bg-premium-dark"></i>
        {{ __('functionalities.menu_admin.general') }}
        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
    </a>
    <ul>
        <li class="{{ Request::is('admin/gen_groups*') ? 'mm-active' : '' }}">
            <a href="{!! route('gen_groups.index') !!}">
                <i class="metismenu-icon"></i>
                <span>@choice('functionalities.gen_groups', 2)</span>
            </a>
        </li>
        <li class="{{ Request::is('admin/gen_lists*') ? 'mm-active' : '' }}">
            <a href="{!! route('gen_lists.index') !!}">
                <i class="metismenu-icon"></i>
                <span>@choice('functionalities.gen_lists', 2)</span>
            </a>
        </li>
    </ul>
</li>

<li>
    <a href="#">
        <i class="metismenu-icon pe-7s-cash icon-gradient bg-premium-dark"></i>
        {{ __('functionalities.menu_admin.plans') }}
        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
    </a>
    <ul>
        <li class="{{ Request::is('admin/plans*') ? 'mm-active' : '' }}">
            <a href="{!! route('plans.index') !!}">
                <i class="metismenu-icon"></i>
                <span>@choice('functionalities.plans', 2)</span>
            </a>
        </li>
        <li class="{{ Request::is('admin/plan_users*') ? 'mm-active' : '' }}">
            <a href="{!! route('plan_users.index') !!}">
                <i class="metismenu-icon"></i>
               <span>@choice('functionalities.plan_users', 2)</span>
            </a>
        </li>
    </ul>
</li>

@endcan