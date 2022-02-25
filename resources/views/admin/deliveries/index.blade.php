<x-app-layout>
    <x-slot name="header">
        Адреса доставки ({{ $deliveries->total() }})
    </x-slot>

    <div class="w-full overflow-hidden rounded-lg shadow-xs mb-20">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Пользователь</th>
                    <th class="px-4 py-3">Фамилия</th>
                    <th class="px-4 py-3">Имя</th>
                    <th class="px-4 py-3">Индекс</th>
                    <th class="px-4 py-3">Область</th>
                    <th class="px-4 py-3">Населённый пункт</th>
                    <th class="px-4 py-3">Улица</th>
                    <th class="px-4 py-3">Дом</th>
                    <th class="px-4 py-3">Квартира</th>
                    <th class="px-4 py-3">Комментарий</th>
                    <th class="px-4 py-3">Дата</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($deliveries as $delivery)
                    <tr class="text-gray-700 dark:text-gray-400 {{ $delivery->status ? 'opacity-70' : '' }}">
                        <td class="px-4 py-3">
                            {{ $delivery->id }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('admin.users.index', ['id' => $delivery->user->id]) }}" class="text-blue-500 underline">{{ $delivery->user->name }} <br> {{ blink()->beautify($delivery->user->phone) }}</a>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $delivery->surname }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $delivery->name }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $delivery->index }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $delivery->region->general }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $delivery->locality }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $delivery->street }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $delivery->building }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $delivery->apartament }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $delivery->commentary }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $delivery->created_at->foramt('d.m.Y H:i') }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="p-4">
                {{ $deliveries->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
