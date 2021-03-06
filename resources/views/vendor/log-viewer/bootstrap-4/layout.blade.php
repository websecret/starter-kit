@extends('admin.root')

@section('layout')
    <div class="flex-fill">
        @include('admin.layouts.partials.header', ['fluid' => config('admin.fluid')])
        @include('admin.layouts.partials.header-nav', ['fluid' => config('admin.fluid')])
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
            <div class="{{ config('admin.fluid') ? 'container-fluid' : 'container' }}">
                <div class="row align-items-center">
                    <div class="col-lg order-lg-first">
                        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                            <li class="nav-item">
                                <a href="{{ route('log-viewer::dashboard') }}"
                                   class="nav-link {{ Route::is('log-viewer::dashboard') ? 'active' : '' }}">
                                    <i class="fe fe-activity"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('log-viewer::logs.list') }}"
                                   class="nav-link{{ Route::is('log-viewer::logs.list') ? 'active' : '' }}">
                                    <i class="fe fe-archive"></i> Logs
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-3 my-md-5">
            <a href="{{ request()->fullUrl() }}" class="pjax js-pjax--current-url"></a>
            <div class="{{ config('admin.fluid') ? 'container-fluid' : 'container' }}">
                <ol class="breadcrumb mt-0">
                    <li class="breadcrumb-item {{ Route::is('log-viewer::dashboard') ? 'active' : '' }}">
                        @if(Route::is('log-viewer::dashboard'))
                            Log Viewer
                        @else
                            <a href="{{ route('log-viewer::dashboard') }}">Log Viewer</a>
                        @endif
                    </li>
                    @stack('breadcrumbs')
                </ol>
                @yield('content')
            </div>
        </div>
    </div>
    @include('admin.layouts.partials.footer', ['fluid' => false])
@endsection

@push('styles')
    <style>

        /*
         * Boxes
         */

        .box {
            display: block;
            padding: 0;
            min-height: 70px;
            background: #fff;
            width: 100%;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            border-radius: .25rem;
        }

        .box > .box-icon > i,
        .box .box-content .box-text,
        .box .box-content .box-number {
            color: #FFF;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
        }

        .box > .box-icon {
            border-radius: 2px 0 0 2px;
            display: block;
            float: left;
            height: 70px;
            width: 70px;
            text-align: center;
            font-size: 40px;
            line-height: 70px;
            background: rgba(0, 0, 0, 0.2);
        }

        .box .box-content {
            padding: 5px 10px;
            margin-left: 70px;
        }

        .box .box-content .box-text {
            display: block;
            font-size: 1rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-weight: 600;
        }

        .box .box-content .box-number {
            display: block;
        }

        .box .box-content .progress {
            background: rgba(0, 0, 0, 0.2);
            margin: 5px -10px 5px -10px;
        }

        .box .box-content .progress .progress-bar {
            background-color: #FFF;
        }

        /*
         * Log Menu
         */

        .log-menu .list-group-item.disabled {
            cursor: not-allowed;
        }

        .log-menu .list-group-item.disabled .level-name {
            color: #D1D1D1;
        }

        /*
         * Log Entry
         */

        .stack-content {
            color: #AE0E0E;
            font-family: consolas, Menlo, Courier, monospace;
            white-space: pre-line;
            font-size: .8rem;
        }

        /*
         * Colors: Badge & Infobox
         */

        .badge.badge-env,
        .badge.badge-level-all,
        .badge.badge-level-emergency,
        .badge.badge-level-alert,
        .badge.badge-level-critical,
        .badge.badge-level-error,
        .badge.badge-level-warning,
        .badge.badge-level-notice,
        .badge.badge-level-info,
        .badge.badge-level-debug,
        .badge.empty {
            color: #FFF;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
        }

        .badge.badge-level-all,
        .box.level-all {
            background-color: {{ log_styler()->color('all') }};
        }

        .badge.badge-level-emergency,
        .box.level-emergency {
            background-color: {{ log_styler()->color('emergency') }};
        }

        .badge.badge-level-alert,
        .box.level-alert {
            background-color: {{ log_styler()->color('alert') }};
        }

        .badge.badge-level-critical,
        .box.level-critical {
            background-color: {{ log_styler()->color('critical') }};
        }

        .badge.badge-level-error,
        .box.level-error {
            background-color: {{ log_styler()->color('error') }};
        }

        .badge.badge-level-warning,
        .box.level-warning {
            background-color: {{ log_styler()->color('warning') }};
        }

        .badge.badge-level-notice,
        .box.level-notice {
            background-color: {{ log_styler()->color('notice') }};
        }

        .badge.badge-level-info,
        .box.level-info {
            background-color: {{ log_styler()->color('info') }};
        }

        .badge.badge-level-debug,
        .box.level-debug {
            background-color: {{ log_styler()->color('debug') }};
        }

        .badge.empty,
        .box.empty {
            background-color: {{ log_styler()->color('empty') }};
        }

        .badge.badge-env {
            background-color: #6A1B9A;
        }
    </style>
@endpush
