<div class="bg-slate-900 text-white min-h-screen p-8"
     x-data="{ open: false, selected: [] }">

    <div class="flex items-center justify-between mb-8">
        <button wire:click="gotoPrevMonth"
            class="px-3 py-1 text-sm text-gray-400 hover:text-white">
            ← Prev
        </button>

        <div class="text-lg font-semibold">
            {{ \Carbon\Carbon::create($currentYear, $currentMonth)->translatedFormat('F Y') }}
        </div>

        <button wire:click="gotoNextMonth"
            class="px-3 py-1 text-sm text-gray-400 hover:text-white">
            Next →
        </button>
    </div>

    <div class="grid grid-cols-7 border-b border-slate-700 text-xs text-slate-400">
        <div class="py-3 text-center">Mon</div>
        <div class="py-3 text-center">Tue</div>
        <div class="py-3 text-center">Wed</div>
        <div class="py-3 text-center">Thu</div>
        <div class="py-3 text-center">Fri</div>
        <div class="py-3 text-center">Sat</div>
        <div class="py-3 text-center">Sun</div>
    </div>

    <div class="grid grid-cols-7 auto-rows-[140px]">

        @foreach($calendar as $day)

            @if($day === null)
                <div class="border-r border-b border-slate-800"></div>
            @else

                @php
                    $hasActivity = isset($activities[$day]);
                    $today = now();
                    $isToday =
                        $today->day == $day &&
                        $today->month == $currentMonth &&
                        $today->year == $currentYear;
                @endphp

                <div class="border-r border-b border-slate-800 p-3 relative hover:bg-slate-800 transition cursor-pointer"
                    @if($hasActivity)
                        @click="selected = {{ json_encode($activities[$day]) }}; open = true"
                    @endif
                >

                    <div class="text-xs text-slate-400">
                        {{ $day }}
                    </div>

                    @if($isToday)
                        <div class="absolute top-2 right-2 w-6 h-6 bg-indigo-500 text-white text-xs flex items-center justify-center">
                            {{ $day }}
                        </div>
                    @endif

                    @if($hasActivity)
                        <div class="mt-3 space-y-1 text-xs">
                            @foreach($activities[$day] as $act)
                                <div class="bg-indigo-600 text-white px-2 py-1 truncate">
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
         class="fixed inset-0 bg-black/60 flex items-center justify-center"
         style="display:none">

        <div class="bg-slate-800 p-6 w-full max-w-lg border border-slate-700"
             @click.outside="open = false">

            <div class="text-lg font-semibold mb-4">
                Kegiatan
            </div>

            <template x-for="act in selected" :key="act.id">
                <div class="mb-4 border-b border-slate-700 pb-3">
                    <div class="font-medium" x-text="act.title_id"></div>
                    <div class="text-sm text-slate-400" x-html="act.description_id"></div>
                </div>
            </template>

            <div class="text-right">
                <button @click="open = false"
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white">
                    Tutup
                </button>
            </div>

        </div>
    </div>

</div>