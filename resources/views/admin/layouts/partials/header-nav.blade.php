<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="{{ $fluid ? 'container-fluid' : 'container' }}">
        <div class="row align-items-center">
            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    @foreach(config('admin.menu', []) as $item)
                        @php
                            $children = array_get($item, 'children', []);
                            $item['children'] = array_filter($children, function ($item) {
                                $route = array_get($item, 'route', '');
                                return auth()->user()->canAccessRoute($route);
                            });
                            $route = array_get($item, 'route', null);
                            if ($route) {
                                $canAccessRoute = auth()->user()->canAccessRoute($route);
                                if (!$canAccessRoute) {
                                    $item['route'] = null;
                                }
                            }
                        @endphp
                        @continue(!array_get($item, 'route') && !count($item['children']))
                        @include('admin.layouts.partials.header-nav-item', [
                            'item' => $item,
                        ])
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>