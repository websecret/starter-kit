@if($models->lastPage() > 1)
    <div class="card-footer">
        <nav>
            {{ $models->links() }}
        </nav>
    </div>
@endif