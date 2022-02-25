<x-app-layout>
    <x-slot name="header">
        Вопросы
    </x-slot>

    <div class="w-full overflow-hidden rounded-lg shadow-xs mb-20">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Текст</th>
                    <th class="px-4 py-3">Перевод</th>
                    <th class="px-4 py-3">Вариант</th>
                    <th class="px-4 py-3">Действия</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($questions as $question)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            {{ $question->id }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $question->general }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $question->locale }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $question->variant_id }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <a href="{{ route('admin.tests.questions.edit', $question->id) }}" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray">
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
        </div>
    </div>
</x-app-layout>
