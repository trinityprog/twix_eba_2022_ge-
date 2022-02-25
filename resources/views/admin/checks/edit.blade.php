<x-app-layout>
    <x-slot name="header">
        Изменение #{{ $check->id }} Чека
    </x-slot>

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="mb-8">
            <a href="{{ url(session()->has('checks_filter') ? session('checks_filter') : route('admin.checks.index')) }}" class="inline-block px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <svg class="w-5 h-5 inline-block align-text-bottom" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Назад
            </a>
        </div>
        <form method="POST" action="{{ route('admin.checks.update', $check->id) }}" class="flex justify-between items-start">
            @csrf
            @method('PUT')

            <div class="">
                <img src="{{ $check->imagePath . '?t=' . time() }}" alt="">
            </div>
            <div class="w-1/3 ml-8">
                <div class="">
                    <p >Повернуть</p>
                    <div class="flex mt-4">
                        <a href="{{ route('admin.checks.rotate', ['id' => $check->id, 'direction' => 'left']) }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            <svg class="w-5 h-5 inline-block align-text-bottom" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M15.707 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 010 1.414zm-6 0a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 011.414 1.414L5.414 10l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                            Налево
                        </a>

                        <a href="{{ route('admin.checks.rotate', ['id' => $check->id, 'direction' => 'right']) }}" class="ml-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            <svg class="w-5 h-5 inline-block align-text-bottom" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-4.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M4.293 15.707a1 1 0 010-1.414L8.586 10 4.293 5.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            Направо
                        </a>
                    </div>
                </div>

                <div class="mt-4">
                    <label for="status" class="block text-sm text-gray-700">Статус</label>
                    <select name="status" id="status"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600
                                {{ $errors->has('status') ? 'focus:border-red-400 focus:outline-none focus:shadow-outline-red' : ''}}">
                        <option value="0" {{ (isset($check->status) && $check->status == 0) ? 'selected' : ''}}>На модерации</option>
                        <option value="1" {{ (isset($check->status) && $check->status == 1) ? 'selected' : ''}}>Принят</option>
                        <option value="2" {{ (isset($check->status) && $check->status == 2) ? 'selected' : ''}}>Отклонен</option>
                    </select>
                    {!! $errors->first('status', '<p class="text-xs text-red-600 dark:text-red-400">:message</p>') !!}
                </div>

                <div  class="mt-4 @if(isset($check->status) && $check->status != 2) hidden @endif" id="comment-group">
                    <label for="comment" class="block text-sm text-gray-700">Причина отказа:</label>
                    <input type="text" id="comment" name="comment" value="{{ isset($check->comment) ? $check->comment : old('comment')}}"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600
                            {{ $errors->has('comment') ? 'focus:border-red-400 focus:outline-none focus:shadow-outline-red' : ''}}"/>
                    {!! $errors->first('comment', '<p class="text-xs text-red-600 dark:text-red-400">:message</p>') !!}
                </div>

                <div class="mt-8">
                    <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            type="submit">
                        Сохранить
                    </button>
                </div>
            </div>

        </form>
    </div>
</x-app-layout>
