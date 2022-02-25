<x-app-layout>
    <x-slot name="header">
        Изменение #{{ $winner->id }} Победителя
    </x-slot>

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="mb-8">
            <a href="{{ url()->previous() }}" class="inline-block px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <svg class="w-5 h-5 inline-block align-text-bottom" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Назад
            </a>
        </div>
        <form method="POST" action="{{ route('admin.winners.update', $winner->id) }}">
            @csrf
            @method('PUT')

            @include ('admin.winners.form')
        </form>
    </div>
</x-app-layout>
