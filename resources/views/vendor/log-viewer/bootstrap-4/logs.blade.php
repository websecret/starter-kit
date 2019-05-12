@extends('log-viewer::bootstrap-4.layout')

@push('title', 'Logs | Log Viewer')

@push('breadcrumbs')
    <li class="breadcrumb-item active">
        Logs
    </li>
@endpush

@section('content')
    <div class="card">
        <div class="card-status bg-blue"></div>
        <div class="table-responsive">
            <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                <thead>
                <tr>
                    @foreach($headers as $key => $header)
                        <th scope="col" class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                            @if ($key == 'date')
                                <span class="badge badge-info">{{ $header }}</span>
                            @else
                                <span class="badge badge-level-{{ $key }}">
                                    {!! log_styler()->icon($key) . ' ' . $header !!}
                                </span>
                            @endif
                        </th>
                    @endforeach
                    <th scope="col" class="text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if ($rows->count() > 0)
                    @foreach($rows as $date => $row)
                        <tr>
                            @foreach($row as $key => $value)
                                <td class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                                    @if ($key == 'date')
                                        <span class="badge badge-primary">{{ $value }}</span>
                                    @elseif ($value == 0)
                                        <span class="badge empty">{{ $value }}</span>
                                    @else
                                        <a href="{{ route('log-viewer::logs.filter', [$date, $key]) }}">
                                            <span class="badge badge-level-{{ $key }}">{{ $value }}</span>
                                        </a>
                                    @endif
                                </td>
                            @endforeach
                            <td class="text-right">
                                <a href="{{ route('log-viewer::logs.show', [$date]) }}" class="btn btn-sm btn-info">
                                    <i class="fe fe-search"></i>
                                </a>
                                <a href="{{ route('log-viewer::logs.download', [$date]) }}"
                                   class="btn btn-sm btn-success">
                                    <i class="fe fe-download"></i>
                                </a>
                                <a href="#delete-log-modal" class="btn btn-sm btn-danger" data-log-date="{{ $date }}">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="11" class="text-center">
                            <span class="badge badge-secondary">{{ trans('log-viewer::general.empty-logs') }}</span>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        {!! $rows->render() !!}
    </div>
@endsection

@push('modals')
    {{-- DELETE MODAL --}}
    <div id="delete-log-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form id="delete-log-form" action="{{ route('log-viewer::logs.delete') }}" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="date" value="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">DELETE LOG FILE</h5>
                        <button type="button" class="btn btn-icon" data-dismiss="modal" aria-label="Close">
                            <i class="fe fe-x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary mr-auto" data-dismiss="modal">Cancel
                        </button>
                        <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Loading&hellip;">DELETE
                            FILE
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endpush

@prepend('scripts')
    <script>
        $(function () {
            var deleteLogModal = $('div#delete-log-modal'),
                deleteLogForm = $('form#delete-log-form'),
                submitBtn = deleteLogForm.find('button[type=submit]');

            $("a[href='#delete-log-modal']").on('click', function (event) {
                event.preventDefault();
                var date = $(this).data('log-date');
                deleteLogForm.find('input[name=date]').val(date);
                deleteLogModal.find('.modal-body p').html(
                    'Are you sure you want to <span class="badge badge-danger">DELETE</span> this log file <span class="badge badge-primary">' + date + '</span> ?'
                );

                deleteLogModal.modal('show');
            });

            deleteLogForm.on('submit', function (event) {
                event.preventDefault();
                submitBtn.button('loading');

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    dataType: 'json',
                    data: $(this).serialize(),
                    success: function (data) {
                        submitBtn.button('reset');
                        if (data.result === 'success') {
                            deleteLogModal.modal('hide');
                            location.reload();
                        } else {
                            alert('AJAX ERROR ! Check the console !');
                            console.error(data);
                        }
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR ! Check the console !');
                        console.error(errorThrown);
                        submitBtn.button('reset');
                    }
                });

                return false;
            });

            deleteLogModal.on('hidden.bs.modal', function () {
                deleteLogForm.find('input[name=date]').val('');
                deleteLogModal.find('.modal-body p').html('');
            });
        });
    </script>
@endprepend
