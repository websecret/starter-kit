<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 ml-auto">
            </div>
            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    @foreach(config('admin.menu', []) as $item)
                        @include('admin.layouts.partials.header-nav-item', [
                            'item' => $item,
                        ])
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>