@extends('layouts.main')

@section('class', 'one-page')

@section('content')
    @include('partials.header')
        <section id="check-register">
            <div class="container {{ $type == 'confirm' ? 'small' : 'main' }}">
                <h2>@lang('index.check-register.title')</h2>

                <p>
                    @lang('index.check-register.info')
                </p>

                <p class="warn">
                    @lang('index.check-register.warn')
                </p>

                <div class="row-special">
                    <img src="{{ asset('/i/example_' . app()->getLocale() . '.png') }}" alt="example">
                    <form action="{{ route('check_register.store') }}"  class="check-register" id="dropzone" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="type" value="{{ $type }}">
                        <div class="fallback">
                            <input type="file" name="image" id="image" style="display: none;">
                        </div>

                        <div class="row">
                            <div class="input-wrap">
                                <input type="text" name="date" placeholder="@lang('index.date')"
                                       @error('date') class="error" @enderror>
                                <span class="error">@error('date') {{ $message }} @enderror</span>
                            </div>
                            <div class="input-wrap">
                                <input type="text" name="time" placeholder="@lang('index.time')"
                                    @error('time') class="error" @enderror>
                                <span class="error">@error('time') {{ $message }} @enderror</span>
                            </div>
                            <div class="input-wrap">
                                <input type="text" name="sum" placeholder="@lang('index.sum')"
                                    @error('sum') class="error" @enderror>
                                <span class="error">@error('sum') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="dz-default dz-message check-zone">
                            <div class="icon"></div>
                            <p class="message">
                                <span data-choosen="@lang('index.check-register.dropzone.choose')" data-info="@lang('index.check-register.dropzone.info')">@lang('index.check-register.dropzone.info')</span>
                                <span class="file-name"></span>
                            </p>
                        </div>

                        <div class="go-wrapper"><button type="submit" class="btn-catch disabled"> @lang('index.check-register.register') </button></div>

                    </form>
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
    <script type="text/javascript">
        $(document).ready(() => {
            window.check_register()
        })
    </script>
@endsection
