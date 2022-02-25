@extends('layouts.main')

@section('class', 'one-page')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <section id="tests">
        <div class="container">
            @livewire('test-user')

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
            window.testuser()
        })
    </script>
@endsection
