<x-app-layout>
    <x-slot name="header">
        Чеки ({{ $checks->total() }})
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
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>На модерации</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Принят</option>
                    <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Отклонен</option>
                </select>
            </div>

            <div class="ml-2">
                <select name="source"
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600">
                    <option value>Выберите источник</option>
                    <option value="web" {{ request('source') == 'web' ? 'selected' : '' }}>web</option>
                    <option value="telegram" {{ request('source') == 'telegram' ? 'selected' : '' }}>telegram</option>
                </select>
            </div>

            <div class="ml-2">
                <select name="type"
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600">
                    <option value>Выберите тип</option>
                    <option value="regular" {{ request('type') == 'regular' ? 'selected' : '' }}>Обычный</option>
                    <option value="confirm" {{ request('type') == 'confirm' ? 'selected' : '' }}>Подтверждение приза</option>
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
                <a href="{{ route('admin.checks.export', request()->all()) }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
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
                    <th class="px-4 py-3">Фотография</th>
                    <th class="px-4 py-3">Дата, время и сумма</th>
                    <th class="px-4 py-3">Статус</th>
                    <th class="px-4 py-3">Тип</th>
                    <th class="px-4 py-3">Источник</th>
                    <th class="px-4 py-3">Дубликаты</th>
                    <th class="px-4 py-3">Дата</th>
                    <th class="px-4 py-3">Действия</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($checks as $check)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            {{ $check->id }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('admin.users.index', ['id' => $check->user->id]) }}" class="text-blue-500 underline">{{ $check->user->name }} <br> {{ blink()->beautify($check->user->phone) }}</a>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ $check->imagePath }}" target="_blank" class="text-blue-500 underline">Ссылка</a>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            Дата {{ $check->date->format('d.m.Y') }} <br>
                            Время {{ $check->time->format('H:i') }} <br>
                            Сумма {{ number_format($check->sum) }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 font-semibold leading-tight rounded-full {{ $check->statusLabelAdminClasses }}">
                              {{ $check->statusText('ru') }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $check->typeText }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $check->source }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('admin.checks.index', ['duplicate' => [$check->date->format('d.m.Y'), $check->time->format('H:i'), $check->sum]]) }}" class="text-blue-500 underline">{{ $check->getDuplicates() }}</a>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $check->created_at->format('d.m.Y H:i') }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <a href="{{ $check->type == 'confirm' && ($check->status == 1 || $check->status == 2) ? '#' : route('admin.checks.edit', $check->id) }}"
                                   class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray {{ $check->type == 'confirm' && ($check->status == 1 || $check->status == 2) ? 'opacity-50' : '' }}">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="p-4">
                {{ $checks->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
