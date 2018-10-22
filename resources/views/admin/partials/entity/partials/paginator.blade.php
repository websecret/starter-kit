@if(!$models->lastPage())
    <div class="card-footer">
        <nav>
            {{ $models->links() }}
        </nav>
    </div>
@endif