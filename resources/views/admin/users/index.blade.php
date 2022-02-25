<x-app-layout>
    <x-slot name="header">
        Пользователи ({{ $users->total() }})
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
                <select name="status"
                       class="block w-full border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600">
                    <option value>Выберите статус</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Проверка номера</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Зарегистрирован</option>
                </select>
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
                <a href="{{ route('admin.users.export', request()->all()) }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
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
                    <th class="px-4 py-3">Имя</th>
                    <th class="px-4 py-3">Телефон</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Источник</th>
                    <th class="px-4 py-3">Статус</th>
                    <th class="px-4 py-3">Тесты</th>
                    @if(config('limits.ACTION') == 'checks')
                        <th class="px-4 py-3">Чеки</th>
                    @endif
                    @if(config('limits.ACTION') == 'scanners')
                        <th class="px-4 py-3">Сканирования</th>
                    @endif
                    <th class="px-4 py-3">Дата</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($users as $user)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            {{ $user->id }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $user->name }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ blink()->beautify($user->phone) }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $user->email }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $user->source }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 font-semibold leading-tight rounded-full {{ $user->status ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' }}">
                              {{ $user->statusText }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('admin.test_users.index', ['user_id' => $user->id]) }}" class="text-blue-500 underline">{{ $user->tests_count }}</a>
                        </td>
                        @if(config('limits.ACTION') == 'checks')
                            <td class="px-4 py-3 text-sm">
                                <a href="{{ route('admin.checks.index', ['user_id' => $user->id]) }}" class="text-blue-500 underline">{{ $user->checks_count }}</a>
                            </td>
                        @endif
                        @if(config('limits.ACTION') == 'scanners')
                            <td class="px-4 py-3 text-sm">
                                <a href="{{ route('admin.scanners.index', ['user_id' => $user->id]) }}" class="text-blue-500 underline">{{ $user->scanners_count }}</a>
                            </td>
                        @endif
                        <td class="px-4 py-3 text-sm">
                            {{ $user->created_at->format('d.m.Y H:i') }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="p-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
