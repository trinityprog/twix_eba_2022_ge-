@extends('layouts.main')

@section('class', 'one-page')

@section('content')
    @include('partials.header')
    <section id="error">
        <div class="container">
            <h1>@lang('index.error.500.title')</h1>
            <h2>@lang('index.error.500.description')</h2>
        </div>
    </section>
    @include('partials.footer')
@endsection
