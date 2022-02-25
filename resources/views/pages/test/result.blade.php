@extends('layouts.main')

@section('class', 'one-page')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <section id="tests">
        <div class="container">
            @if($test->prize)
                <div class="tab action-box user-can" data-id="1">@include('pages.test.prize_given')</div>
            @endif

            @if(! $test->prize && $canAction)
                <div class="tab action-box user-can no-prize" data-id="1">@include('pages.test.prize_no_given')</div>
            @endif

            <div class="tab action-box user-cannot" data-id="2">@include('pages.test.moment')</div>

            <div class="tab_nav" style="display: none;"><span class="tab_button active" data-id="1"></span><span class="tab_button" data-id="2"></span></div>

            <div>@include('partials.twixes')</div>
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
    <script type="text/javascript">
        $(document).ready(() => {
            window.test_result()
        })
    </script>
@endsection
