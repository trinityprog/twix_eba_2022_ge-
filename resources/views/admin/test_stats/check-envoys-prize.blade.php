<x-app-layout>
    <x-slot name="header">
        Stats
    </x-slot>

    <div class="w-full overflow-hidden rounded-lg shadow-xs mb-20">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($envs as $e)
                    <tr class="text-gray-700 dark:text-gray-400">
                        @php
                            $ph = blink()->beautify(json_decode($e->response)->person_id);
                            $cd = json_decode($e->response)->prize->prize_id;
                            $gm = json_decode($e->response)->game_id;
                            $tm = $e->created_at->format('d.m.Y H:i');
                        @endphp
                        <td class="px-4 py-3">
                            {{ $ph }} <br>
                            {{ $cd }} <br>
                            {{ $gm }} <br>
                            {{ $tm }}
                        </td>
                        @php
                            $tests = \App\Models\TestUser::query()
                                ->whereHas('user', fn($q) => $q->where('phone', blink()->clear($ph)))
                                ->get();
                        @endphp
                        <td class="px-4 py-3">
                            @foreach($tests as $t)
                                @php
                                    $_ph = '#phone';
                                    $_cd = '#prize';
                                    $_gm = '#game';
                                    $_tm = '#time';

                                if($t->prize || $t->api_game_id == $gm) {
                                    $_ph = blink()->beautify($t->user->phone);
                                    $_cd = $t->prize ? $t->prize->codename : '#prize';
                                    $_gm = $t->api_game_id;
                                    $_tm = $t->created_at->format('d.m.Y H:i');
                                }
                                @endphp
                                    {{ $_ph }} <br>
                                    {{ $_cd }} <br>
                                    {{ $_gm }} <br>
                                    {{ $_tm }} <br><br><br>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
