<div class="bg-white max-w-5xl mx-auto"
     x-data="{ open: false, selected: [] }">

    <div class="flex items-center justify-between mb-8">
        <button wire:click="gotoPrevMonth"
            class="px-3 py-1 text-sm border border-gray-300 hover:bg-gray-100">
            ← Prev
        </button>

        <div class="text-lg font-semibold text-gray-800">
            {{ \Carbon\Carbon::create($currentYear, $currentMonth)->translatedFormat('F Y') }}
        </div>

        <button wire:click="gotoNextMonth"
            class="px-3 py-1 text-sm border border-gray-300 hover:bg-gray-100">
            Next →
        </button>
    </div>

    <div class="grid grid-cols-7 border border-gray-300 text-xs text-gray-600">
        <div class="py-3 text-center border-r border-b border-gray-300">Mon</div>
        <div class="py-3 text-center border-r border-b border-gray-300">Tue</div>
        <div class="py-3 text-center border-r border-b border-gray-300">Wed</div>
        <div class="py-3 text-center border-r border-b border-gray-300">Thu</div>
        <div class="py-3 text-center border-r border-b border-gray-300">Fri</div>
        <div class="py-3 text-center border-r border-b border-gray-300">Sat</div>
        <div class="py-3 text-center border-b border-gray-300">Sun</div>

        @foreach($calendar as $day)

            @if($day === null)
                <div class="border-r border-b border-gray-300 h-36"></div>
            @else

                @php
                    $hasActivity = isset($activities[$day]);
                    $today = now();
                    $isToday =
                        $today->day == $day &&
                        $today->month == $currentMonth &&
                        $today->year == $currentYear;
                @endphp

                <div class="border-r border-b border-gray-300 p-3 relative hover:bg-gray-50 transition cursor-pointer h-36"
                    @if($hasActivity)
                        @click="selected = {{ json_encode($activities[$day]) }}; open = true"
                    @endif
                >

                    <div class="text-xs {{ $isToday ? 'font-bold text-black' : 'text-gray-500' }}">
                        {{ $day }}
                    </div>

                    @if($hasActivity)
                        <div class="mt-3 space-y-1 text-xs">
                            @foreach($activities[$day] as $act)
                                <div class="border border-gray-300 px-2 py-1 bg-gray-100 truncate">
                                    {{ $act->title_id }}
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>

            @endif

        @endforeach

    </div>

    <div x-show="open"
         x-transition.opacity
         class="fixed inset-0 bg-black/40 flex items-center justify-center"
         style="display:none">

        <div class="bg-white p-6 w-full max-w-lg border border-gray-300"
             @click.outside="open = false">

            <div class="text-lg font-semibold mb-4 text-gray-800">
                Kegiatan
            </div>

            <template x-for="act in selected" :key="act.id">
                <div class="mb-4 border-b border-gray-200 pb-3">
                    <div class="font-medium" x-text="act.title_id"></div>
                    <div class="text-sm text-gray-600" x-html="act.description_id"></div>
                </div>
            </template>

            <div class="text-right">
                <button @click="open = false"
                        class="px-4 py-2 border border-gray-300 hover:bg-gray-100">
                    Tutup
                </button>
            </div>

        </div>
    </div>

</div>