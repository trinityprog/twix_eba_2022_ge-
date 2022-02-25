@php
    $arrow_svg = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve"><g> <g> <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12    C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084    c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864    l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>';
@endphp

@if ($paginator->hasPages())
    <div class="pagination">
        <ul class="pagination-pages">

            {{-- Start Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="pagination-start">
                    <span>
                        {!! $arrow_svg !!}
                        {!! $arrow_svg !!}
                    </span>
                </li>
            @else
                <li class="pagination-start">
                    <a href="javascript:void(0)" wire:click="gotoPage({{ 1 }})">
                        {!! $arrow_svg !!}
                        {!! $arrow_svg !!}
                    </a>
                </li>
            @endif

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="pagination-prev">
                    <span>
                        {!! $arrow_svg !!}
                    </span>
                </li>
            @else
                <li class="pagination-prev">
                    <a href="javascript:void(0)" wire:click="previousPage">
                        {!! $arrow_svg !!}
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)

                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="pagination-ellipsis disabled">
                        <a>{{ $element }}</a>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)

                        @if ($page == $paginator->currentPage())
                            <li class="pagination-page active">
                                <span>{{ $page }}</span>
                            </li>
                        @else
                            <li class="pagination-page">
                                <a href="javascript:void(0)" wire:click="gotoPage({{ $page }})">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif

            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="pagination-next">
                    <a href="javascript:void(0)" wire:click="nextPage">
                        {!! $arrow_svg !!}
                    </a>
                </li>
            @else
                <li class="pagination-next">
                    <span>{!! $arrow_svg !!}</span>
                </li>
            @endif

            {{-- End Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="pagination-end">
                    <a href="javascript:void(0)" wire:click="gotoPage({{ $paginator->lastPage() }})">
                        {!! $arrow_svg !!}
                        {!! $arrow_svg !!}
                    </a>
                </li>
            @else
                <li class="pagination-end">
                    <span>
                        {!! $arrow_svg !!}
                        {!! $arrow_svg !!}
                    </span>
                </li>
            @endif

        </ul>
    </div>
@endif
