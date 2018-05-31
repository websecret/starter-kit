@extends('admin.partials.entity.index', ['section' => 'users', 'items' => $users])

@section('table')
    <div class="table-responsive">
        <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
            <thead>
            <tr>
                <th class="text-center w-1">#</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Зарегистрирован</th>
                <th class="text-center"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="text-center">
                        <div class="small text-muted">{{ $user->id }}</div>
                    </td>
                    <td>
                        <div>
                            <a href="{{ route('admin.users.edit', $user) }}">
                                {{ $user->full_name }}
                            </a>
                        </div>
                    </td>
                    <td>
                        <div>{{ $user->email }}</div>
                    </td>
                    <td>
                        <div class="small text-muted">{{ $user->created_at->format('d.m.Y H:i') }}</div>
                        <div>{{ Date::instance($user->created_at)->diffForHumans() }}</div>
                    </td>
                    <td class="text-center">
                        <div class="item-action dropdown">
                            <a href="#" data-toggle="dropdown" class="icon">
                                <i class="fe fe-more-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                @include('admin.partials.entity.actions.dropdown-edit', [
                                    'link' => route('admin.users.edit', $user)
                                ])
                                @include('admin.partials.entity.actions.dropdown-delete', [
                                    'link' => route('admin.users.delete', $user)
                                ])
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @if($users->total() > 1)
        <div class="card-footer">
            <nav>
                {{ $users->links() }}
            </nav>
        </div>
    @endif
@endsection