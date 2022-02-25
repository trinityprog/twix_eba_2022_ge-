@extends('layouts.main')

@section('class', 'one-page')

@section('content')
    @include('partials.header')
    <section id="scan_upload">
        <div class="container">
            <h1>@lang('index.scan.title')</h1>
            <h2>@lang('index.scan.sub')</h2>
            <form action="{{ url()->current() }}" method="POST" enctype="multipart/form-data" class="upload-area">
            </form>
            @include('partials.twixes')
        </div>
    </section>
    @include('partials.footer')
    @include('partials.modals')
@endsection
