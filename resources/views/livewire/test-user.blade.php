<div>
    @if($step == 0)
        <div class="action-box test-start">
            <h2>
                @lang('index.tests.title')
            </h2>
            <p>
                @lang('index.tests.info')
            </p>
            <div class="choose-block">
                <img class="choose active" src="{{ url('/i/left.png') }}" alt="">
                <img class="choose" src="{{ url('/i/right.png') }}" alt="">

                <img class="cursor" src="{{ url('/i/cursor.svg') }}" alt="cursor">
            </div>
            <div class="go-wrapper"><a class="btn-catch" href="#" wire:click="firstStep()">@lang('index.tests.start')</a></div>
        </div>
    @endif
    @if($step > 0)
        <div class="action-box test-process">
            <h2>
                @lang('index.tests.title')
            </h2>
            <p>
                {{ $question->text }}
            </p>
            <div class="choose-block">
                @foreach($question->answers as $answer)
                    <a href="#" wire:click="selectAnswer({{$answer->id}})">
                        <img class="choose" src="{{ $answer->imagePath }}" alt="" >
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
