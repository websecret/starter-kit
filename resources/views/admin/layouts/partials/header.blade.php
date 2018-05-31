<div class="header py-4">
    <div class="container">
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
                                        <small class="text-muted d-block mt-1">Administrator</small>
                                    </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#todo">
                                <i class="dropdown-icon fe fe-settings"></i> Настройки
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#todo" >
                                <i class="dropdown-icon fe fe-log-out"></i> Выйти
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>