@extends('layouts.main')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <section id="hero">

        @handheld
        <div class="container">
            <h1>
                @lang('index.main.title')
            </h1>
            <div class="go-wrapper"><a class="btn-catch" id="go-btn" href="{{ route('test') }}">@lang('index.header.catch')</a></div>
        </div>
        @endhandheld

        <div class="container">
            <div class="left image-blocks">
                <div class="titles top">
                    <span>
                        @lang('index.left')
                    </span>
                </div>
                <img class="hero-images" src="{{ url('/i/twix_with_hand.png') }}" alt="twix_with_hand">
                <div class="titles bot">
                    <span>
                        @lang('index.right')
                    </span>
                </div>
            </div>
            <div class="right image-blocks">
                @desktop
                <h1>
                    @lang('index.main.title')
                </h1>
                <div class="go-wrapper"><a class="btn-catch" id="go-btn" href="{{ route('test') }}"> @lang('index.header.catch') </a></div>
                @enddesktop
                <img class="hero-images" src="{{ url('/i/mug.png') }}" alt="coffee mug">
                <div class="vapour">
                    <span style="--v:1;"></span>
                    <span style="--v:2;"></span>
                    <span style="--v:5;"></span>
                    <span style="--v:4;"></span>
                    <span style="--v:6;"></span>
                    <span style="--v:19;"></span>
                    <span style="--v:7;"></span>
                    <span style="--v:8;"></span>
                    <span style="--v:9;"></span>
                    <span style="--v:1;"></span>
                    <span style="--v:11;"></span>
                    <span style="--v:5;"></span>
                    <span style="--v:21;"></span>
                    <span style="--v:7;"></span>
                    <span style="--v:8;"></span>
                    <span style="--v:19;"></span>
                    <span style="--v:7;"></span>
                    <span style="--v:12;"></span>
                    <span style="--v:8;"></span>
                </div>
            </div>
        </div>
    </section>
    <section id="rules">
        <div class="cover"></div>
        <div class="container">
            <h2>
                @lang('index.main.catch-twix')
            </h2>
            <div class="box">
                <div class="left">
                    <div class="choose-block">
                        <img class="choose active" src="{{ url('/i/left.png') }}" alt="">
                        <img class="choose" src="{{ url('/i/right.png') }}" alt="">

                        <img class="cursor" src="{{ url('/i/cursor.svg') }}" alt="cursor">
                    </div>
                    <p>
                        @lang('index.main.pass-test')
                    </p>
                </div>
                <div class="right">
                    <div class="wrapper">
                        <div class="swiper-box" id="rules-swiper">
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                @foreach($prizes_images as $image)
                                    <div class="swiper-slide">
                                        <img class="content" src="{{ $image }}" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="bg"></div>

                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"><img class="nav-arrow" src="{{ url('/i/nav.svg') }}" alt="">
                        </div>
                        <div class="swiper-button-next"><img class="nav-arrow" src="{{ url('/i/nav.svg') }}" alt="">
                        </div>
                    </div>
                    <p>
                        @lang('index.main.win-everyday')
                    </p>
                    <div class="go-wrapper"><a class="btn-catch" href="{{ route('test') }}">@lang('index.header.catch')</a></div>
                </div>
            </div>
            <a href="{{ route('rules_file') }}" class="rules">@lang('index.main.rules')</a>
        </div>
    </section>
    <section id="mechanics">
        <div class="container">
            <h2>
                @lang('index.main.want-more')
            </h2>
            <h3>
                @lang('index.main.upload-info')
            </h3>
            <div id="card" class="el">
                <div id="card_inner" class="el">
                    <img src="{{ url('../i/card.png') }}" id="card_img"/>
                    <div class="text-box">
                        <span class="amount">@lang('index.main.amount')</span>
                        <span class="text">@lang('index.main.for-me')</span>
                    </div>
                    <img src="{{ url('../i/grad.png') }}" id="card_grad"/>
                </div>
            </div>

            <div class="go-wrapper"><a class="btn-catch" href="{{ route('check_register.index') }}"> @lang('index.header.upload-check') </a></div>
            @include('partials.twixes')
        </div>
    </section>
    <section id="winners">
        <div class="container">
            <h2> @lang('index.main.winners') </h2>

            @livewire('search-by-phone')

            <div class="table">
                <div x-data="{ selected_table: 'instant' }" id="tab_wrapper">
                    <nav>
                        <a :class="{ 'active': selected_table === 'instant' }" href="#"
                           @click.prevent="selected_table = 'instant'; window.livewire.emit('changeTable', 'instant')">
                            @lang('index.main.momental')
                        </a>
                        <a :class="{ 'active': selected_table === 'weekly' }" href="#"
                            @click.prevent="selected_table = 'weekly'; window.livewire.emit('changeTable', 'weekly')">
                            @lang('index.main.weekly')
                        </a>
                    </nav>
                </div>
                <div class="table-head">
                    <div class="row">
                        <div> @lang('index.date') </div>
                        <div> @lang('index.phone') </div>
                        <div> @lang('index.prize') </div>
                    </div>
                </div>
                @livewire('winners-table')
            </div>
        </div>
    </section>
    <section id="faq">
        <div class="container">
            <h2> @lang('index.main.faq-title') </h2>
            <p class="text-warn">
                @lang('index.main.faq-info')
            </p>
            @livewire('question-send')

            <div class="faq-list" x-data="{ faq_selected: null }">
                @foreach($faqs as $faq)
                    <div class="list-item" x-data="{ item: {{ $loop->iteration }} }">
                        <div :class="{'active' : faq_selected == item }" class="question" @click="faq_selected != item ? faq_selected = item : faq_selected = null">{{ $faq->question }}</div>
                        <div class="answer" x-bind:style="faq_selected == item ? `max-height:  ${ $el.scrollHeight }px` : ``"><div>{!! $faq->answer !!}</div></div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.goup')
    @include('partials.footer')
@endsection

@section('modals')
    @include('partials.modals')
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(() => {
            window.index()
        })
    </script>
@endsection
