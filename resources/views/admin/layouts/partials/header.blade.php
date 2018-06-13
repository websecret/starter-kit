<div class="header py-4">
    <div class="{{ $fluid ? 'container-fluid' : 'container' }}">
        <div class="d-flex">
            <a class="header-brand" href="{{ route('admin.home.index') }}">
                @if(config('admin.logo'))
                    <img src="{{ asset(config('admin.logo')) }}" class="header-brand-img" alt="{{ config('admin.title') }}">
                @else
                    {{ config('admin.title') }}
                @endif
            </a>
            <div class="d-flex order-lg-2 ml-auto">
                @if(auth()->user())
                    <div class="dropdown">
                        <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                            {{--<span class="avatar" style="background-image: url(./demo/faces/female/25.jpg)"></span>--}}
                            <span class="ml-2 d-none d-lg-block">
                                <span class="text-default">{{ auth()->user()->fullName }}</span>
                                <small class="text-muted d-block mt-1">{{ optional(auth()->user()->role)->name }}</small>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            {{--<a class="dropdown-item" href="#todo">--}}
                                {{--<i class="dropdown-icon fe fe-settings"></i> Настройки--}}
                            {{--</a>--}}
                            {{--<div class="dropdown-divider"></div>--}}
                            <a class="dropdown-item" href="{{ action('Admin\Auth\LoginController@logout') }}" >
                                <i class="dropdown-icon fe fe-log-out"></i> {{ __('theme.logout') }}
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
            </a>
        </div>
    </div>
</div>