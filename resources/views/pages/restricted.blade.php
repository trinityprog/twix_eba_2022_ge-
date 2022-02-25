@extends('layouts.main')

@section('class', 'one-page')

@section('content')
    @include('partials.header')
    <section id="error">
        <div class="container">
            <h1>@lang('index.restricted.title')</h1>
            <div class="go-wrapper">
                <a href="{{ route('index') }}" class="btn-catch">{{ __('index.restricted.btn') }}</a>
            </div>
        </div>
    </section>
    @include('partials.footer')
@endsection
