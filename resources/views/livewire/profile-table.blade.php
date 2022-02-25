<div>
    <div class="table-body">
        @foreach($data as $row)
            <div class="row">
                <div>{{ $row->created_at->format('d.m.Y') }}</div>
                <div><a data-fancybox="checks" href="{{ $row->imagePath }}">@lang('index.profile.look')</a></div>
                <div><span data-check-status="{{ $row->status ?? '' }}" data-check-comment="{{ $row->comment ?? '' }}" data-color="{{ $row->statusColorName }}">{{ $row->statusText() }}</span></div>
{{--                <div><span data-check-status="{{ $row->status ?? '' }}" data-check-comment="{{ $row->comment ?? '' }}" data-color="{{ $row->statusColorName }}">{{ $row->statusText }}</span> <a data-fancybox="checks" href="{{ $row->photoPath }}">@lang('index.form.show_photo_mobile')</a></div>--}}
            </div>
        @endforeach
        @for($i = 0; $i < ($data->perPage() - $data->count()); $i++)
            <div class="row"><div></div><div></div><div></div></div>
        @endfor
    </div>
    {!! $data->links() !!}
</div>
