<x-app-layout>
    <x-slot name="header">
        Тесты Пользователей ({{ $test_users->total() }})
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
            <div class="ml-auto">
                <a href="{{ route('admin.test_users.export', request()->all()) }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    <svg class="w-4 h-4 inline-block align-text-bottom" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    Экспорт
                </a>
            </div>
        </form>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs mb-20">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Пользователь</th>
                    <th class="px-4 py-3">Результат</th>
                    <th class="px-4 py-3">Приз</th>
                    <th class="px-4 py-3">Запрос</th>
                    <th class="px-4 py-3">Источник</th>
                    <th class="px-4 py-3">Адрес доставки</th>
                    <th class="px-4 py-3">Дата</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($test_users as $test_user)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            {{ $test_user->id }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('admin.users.index', ['id' => $test_user->user->id]) }}" class="text-blue-500 underline">{{ $test_user->user->name }} <br> {{ blink()->beautify($test_user->user->phone) }}</a>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('admin.tests.results.index', ['id' => $test_user->result->id]) }}" class="text-blue-500 underline">{{ $test_user->result->showAnswersText }}</a>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            @if($test_user->prize)
                                <a href="{{ route('admin.prizes.index', ['id' => $test_user->prize->id]) }}" class="text-blue-500 underline inline-block mb-2">{{ $test_user->prize->general }}</a>
                                <br>
                                @php $confirmCheck = $test_user->user->checks()->where('type', 'confirm')->latest()->first(); @endphp
                                @if($test_user->check)
                                    <a href="{{ route('admin.checks.index', ['id' => $test_user->check->id]) }}" class="px-2 py-1 inline-block font-semibold leading-tight rounded-full text-green-700 bg-green-100">Принят</a>
                                @elseif($confirmCheck)
                                    <a href="{{ route('admin.checks.index', ['id' => $confirmCheck->id]) }}" class="px-2 py-1 inline-block font-semibold leading-tight rounded-full {{ $confirmCheck->statusLabelAdminClasses }}">{{ $confirmCheck->statusText('ru') }}</a>
                                @else
                                    <span class="px-2 py-1 inline-block font-semibold leading-tight rounded-full text-red-600 bg-red-100">не загружен чек</span>
                                @endif
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="
{{--{{ route('admin.envoy.index', ['id' => $test_user->envoy->id]) }}--}}
                                " class="text-blue-500 underline">Ссылка</a>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $test_user->source }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            @if($test_user->user->delivery)
                                <a href="{{ route('admin.deliveries.index', ['id' => $test_user->user->delivery->id]) }}" class="text-blue-500 underline inline-block mb-2">Ссылка</a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $test_user->created_at->format('d.m.Y H:i') }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="p-4">
                {{ $test_users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
