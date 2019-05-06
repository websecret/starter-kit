@extends('log-viewer::bootstrap-4.layout')

@push('title', 'Log Viewer')

@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="card p-4">
                <div class="card-status bg-blue"></div>
                <canvas id="stats-doughnut-chart" height="300"></canvas>
            </div>
        </div>

        <div class="col-md-6 col-lg-9">
            <div class="card p-4">
                <div class="card-status bg-blue"></div>
                <div class="row">
                    @foreach($percents as $level => $item)
                        <div class="col-sm-6 col-md-12 col-lg-4 mb-3">
                            <div class="box level-{{ $level }} {{ $item['count'] === 0 ? 'empty' : '' }}">
                                <div class="box-icon pt-4">
                                    {!! log_styler()->icon($level) !!}
                                </div>

                                <div class="box-content">
                                    <span class="box-text">{{ $item['name'] }}</span>
                                    <span class="box-number">
                                    {{ $item['count'] }} entries - {!! $item['percent'] !!} %
                                </span>
                                    <div class="progress" style="height: 3px;">
                                        <div class="progress-bar" style="width: {{ $item['percent'] }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
        new Chart(document.getElementById("stats-doughnut-chart"), {
            type: 'doughnut',
            data: {!! $chartData !!},
            options: {
                legend: {
                    position: 'bottom'
                }
            }
        });
    </script>
@endpush
