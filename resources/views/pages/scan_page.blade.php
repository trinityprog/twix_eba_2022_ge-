@extends('layouts.main')

@section('class', 'one-page')

@section('content')
    @include('partials.header')
    <section id="scan">
        <div class="container">
            <h1>@lang('index.scan.title')</h1>
            <h2>@lang('index.scan.sub')</h2>
            <div class="scan-area"></div>
            @include('partials.twixes')
        </div>
    </section>
    @include('partials.footer')
@endsection
