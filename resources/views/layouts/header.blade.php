<div class="app-header header-shadow bg-midnight-bloom header-text-light">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>    
    <div class="app-header__content">
        <div class="app-header-left">
        
        </div>
        <div class="app-header-right">
            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <a href="{{ route('notifications.index') }}" class="p-0 btn">
                                    <img width="32" src="{{ asset('images/global.png') }}" alt="">
                                        @if(count(auth()->user()->unreadNotifications))
                                           <span class="badge badge-pill badge-danger">
                                               {{ count(auth()->user()->unreadNotifications) }}
                                           </span>
                                        @endif
                                </a>
                            </div>

                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                    <img width="32" class="rounded-circle" src="{{ asset('images/default-ranger.png') }}" alt="">
                                    <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('account.index') }}">@choice('functionalities.account', 1)</a>

                                    <div tabindex="-1" class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __(' Cerrar sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content-left  ml-3 header-user-info">
                            @auth
                                <div class="widget-heading">
                                    {{ Auth::user()->username }}
                                </div>
                                <div class="widget-subheading">
                                    {{ Auth::user()->first_name ." ". Auth::user()->last_name}}
                                </div>
                            @endauth
                        </div>
                        
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div> 