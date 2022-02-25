@extends('layouts.main')

@section('header')
    @include('partials.header')
@endsection

@section('class', 'one-page delivery')

@section('content')
    <section id="delivery">
        <div class="container">
            <p>
                @lang('index.delivery.info')
            </p>

            <p>
                @lang('index.delivery.sub-info')
            </p>

            @desktop
            <p>
                @lang('index.delivery.required')
            </p>
            @enddesktop

            <div class="action-box">
                <div class="left">
                    <div class="prize">
                        <h3>
                            @lang('index.delivery.your-prize')
                        </h3>
                        <img src="{{ $test_prize->prize->imagePath }}" alt="slide1">
                        <div class="row">
                            <h3>
                                @lang('index.delivery.date-won') <br>
                                {{ $test_prize->created_at->format('d.m.Y') }}
                            </h3>
                            <h3>
                                @lang('index.delivery.your-mobile') <br>
                                {{ blink()->beautify(auth()->user()->phone) }}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="right">
                    @handheld
                    <p>
                        @lang('index.delivery.required')
                    </p>
                    @endhandheld
                    @livewire('delivery')
                </div>
            </div>
            <p>
                @lang('index.delivery.terms')
            </p>
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
    <script type="text/javascript">
    </script>
@endsection
