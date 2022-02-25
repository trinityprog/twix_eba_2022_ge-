<div>
    <div class="table-data">
        @foreach($data as $row)
            <div class="row">
                <div>{{ $row['date'] }}</div>
                <div>{{ $row['phone'] }}</div>
                <div>{{ $row['prize_name'] }}</div>
            </div>
        @endforeach
        @for($i = 0; $i < ($data->perPage() - $data->count()); $i++)
            <div class="row"><div></div><div></div><div></div></div>
        @endfor
    </div>

    {!! $data->links() !!}
</div>
