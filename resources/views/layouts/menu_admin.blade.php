@can('super_all')

<li class="app-sidebar__heading">@choice('functionalities.menu_admin.administration', 2)</li>
<li>
    <a href="#">
        <i class="metismenu-icon pe-7s-users icon-gradient bg-premium-dark"></i>
        {{ __('functionalities.menu_admin.user_management') }}
        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
    </a>
    <ul>
        <li class="{{ Request::is('users*') ? 'active' : '' }}">
            <a href="{!! route('users.index') !!}">
                <i class="metismenu-icon"></i>
                @choice('functionalities.users', 2)
            </a>
        </li>
        <li class="{{ Request::is('roles*') ? 'active' : '' }}">
            <a href="{!! route('roles.index') !!}">
                <i class="metismenu-icon"></i>
                @choice('functionalities.roles', 2)
            </a>
        </li>
        <li class="{{ Request::is('abilities*') ? 'active' : '' }}">
            <a href="{!! route('abilities.index') !!}">
                <i class="metismenu-icon"></i>
                @choice('functionalities.abilities', 2)
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
        <li class="{{ Request::is('gen_groups*') ? 'active' : '' }}">
            <a href="{!! route('gen_groups.index') !!}">
                <i class="metismenu-icon"></i>
                @choice('functionalities.gen_groups', 2)
            </a>
        </li>
        <li class="{{ Request::is('gen_lists*') ? 'active' : '' }}">
            <a href="{!! route('gen_lists.index') !!}">
                <i class="metismenu-icon"></i>
                @choice('functionalities.gen_lists', 2)
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
        <li class="{{ Request::is('plans*') ? 'active' : '' }}">
            <a href="{!! route('plans.index') !!}">
                <i class="metismenu-icon"></i>
                @choice('functionalities.plans', 2)
            </a>
        </li>
        <li class="{{ Request::is('plan_users*') ? 'active' : '' }}">
            <a href="{!! route('plan_users.index') !!}">
                <i class="metismenu-icon"></i>
               @choice('functionalities.plan_users', 2)
            </a>
        </li>
    </ul>
</li>

@endcan