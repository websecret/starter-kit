@foreach($rows as $row)
    <div class="row">
        {!! $row->renderFields() !!}
    </div>
@endforeach