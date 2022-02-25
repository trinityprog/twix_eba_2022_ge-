@extends('layouts.main')

@section('header')
    @include('partials.header', ['class' => 'absolute'])
@endsection

@section('class', 'one-page')

@section('content')
    <section id="scan_upload">
        <div class="container">
            <h1>@lang('index.scan.title')</h1>
            <h2>@lang('index.scan.sub')</h2>
            <div id='label-container' style="display: none;"></div>
            <div class="form" id="dropzone">
                @csrf
                <img class="aim" src="{{ url('../i/aim.png') }}" alt="">
                <form action="{{ url('/scanner/store') }}" method="POST" enctype="multipart/form-data" id="screenshot_form" class="upload-area" style="visibility: hidden">
                    @csrf
                    <input type="hidden" name="type" value="{{ $type }}">
                    <input type="hidden" name="screenshot" id="screenshot_input">
                </form>
                <video class="advancedCam" autoplay playsinline muted></video>
                <canvas class="advancedBox" style="position:absolute;"></canvas>
                <canvas id="hiddencanvs" style="position:absolute; visibility: hidden;"></canvas>
            </div>
            @include('partials.twixes')
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.footer')
@endsection

@section('modals')
    @include('partials.modals')
@endsection

@section('scripts')
    <script src="{{ url('js/ml_twix.js?v='.mt_rand(111111,999999)) }}"></script>

    <script type="text/javascript">
        $('document').ready(() => {

        })
    </script>
@endsection
