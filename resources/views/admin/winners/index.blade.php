<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1>
                Победители ({{ $winners->total() }})
            </h1>
            <a href="{{ route('admin.winners.create') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <svg class="w-4 h-4 inline-block align-text-bottom" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Создать
            </a>
        </div>
    </x-slot>

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
        <form method="GET" class="flex items-center">
            <div>
                <input type="date" name="date[]"
                       value="{{ request()->has('date') ? request('date')[0] : '' }}"
                       class="block w-full border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600"/>
            </div>

            <div class="ml-2">
                <input type="date" name="date[]"
                       value="{{ request()->has('date') ? request('date')[1] : '' }}"
                       class="block w-full border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600"/>
            </div>

            <div class="ml-2">
                <div class="relative text-gray-500">
                    <input type="text" name="search_by_phone" value="{{request()->has('search_by_phone') ? request('search_by_phone') : ''}}" placeholder="Поиск по номеру"
                        class="block w-full pr-20 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600"/>
                    <button type="submit"
                        class="absolute inset-y-0 right-0 px-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-r-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs mb-20">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Телефон</th>
                    <th class="px-4 py-3">Приз</th>
                    <th class="px-4 py-3">Дата</th>
                    <th class="px-4 py-3">Действия</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($winners as $winner)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            {{ $winner->id }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ blink()->beautify($winner->user->phone) }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $winner->prize->general }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $winner->won_at->format('d.m.Y') }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <a href="{{ route('admin.winners.edit', $winner->id) }}" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </a>

                                <form method="POST" action="{{ route('admin.winners.destroy', $winner->id) }}" class="ml-2 inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Вы точно хотите удалить?')" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="p-4">
                {{ $winners->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
