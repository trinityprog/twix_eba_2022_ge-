@extends('layouts.main')

@section('header')
    @include('partials.header')
@endsection

@section('class', 'one-page')

@section('content')
    <section id="profile">
        <div class="container {{ $hasNotActivatedPrize || $isWinner ? '' : 'no-prize' }}">

         @desktop
            @include('partials.profile_prize')
         @enddesktop

            <div class="profile-info">
                <h1>{{ blink()->beautify(auth()->user()->phone) }}</h1>
                <div class="row-special">
                    <div class="go-wrapper"><a class="btn-catch" href="{{ route('check_register.index') }}">@lang('index.header.upload-check')</a></div>
                    <div class="wrapper">
                        <h3>
                            {!! __('index.profile.total', ['count' => $checks_count]) !!}
                        </h3>
                        <div class="title">
                            @lang('index.profile.participate')
                        </div>
                    </div>
                </div>
                <h5>
                    @lang('index.profile.important')
                </h5>

                @handheld
                    @include('partials.profile_prize')
                @endhandheld

                <div class="table">
                    <div class="table-head">
                        <div class="row">
                            <div>@lang('index.date')</div>
                            <div>@lang('index.profile.photo')</div>
                            <div>@lang('index.profile.status')</div>
                        </div>
                    </div>
                    @livewire('profile-table')
                </div>
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
    <div class="remodal footer-modal" data-remodal-id="check_comment">
        <button data-remodal-action="close" class="remodal-close"></button>
        <div class="content">
            <div class="body"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('document').ready(() => {
            $('h3[data-check-comment] a').click(function () {
                let status = $(this).parent().data('check-status');
                let comment = $(this).parent().data('check-comment');
                if(status === 2 && comment.length > 0) {
                    let modal = $('[data-remodal-id=check_comment]');
                    modal.find('.body').text(comment)
                    modal.remodal().open();
                }
            });

            $('span[data-check-comment]').click(function () {
                let status = $(this).data('check-status');
                let comment = $(this).data('check-comment');
                if(status === 2 && comment.length > 0) {
                    let modal = $('[data-remodal-id=check_comment]');
                    modal.find('.body').text(comment)
                    modal.remodal().open();
                }
            });
        })
    </script>
@endsection
