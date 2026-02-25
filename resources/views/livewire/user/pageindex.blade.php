<div class="w-full space-y-12 mx-auto py-12">

    <div class="mx-auto px-4 sm:px-6 lg:px-0 max-w-5xl space-y-6">

        <div class="space-y-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-14 items-start">

                <div class="lg:mt-[52px]">
                    <div class="text-red-600 text-xs mb-2">Rekomendasi</div>
                    <div class="text-blue-700 font-bold text-lg leading-snug mb-4">
                        Dari #QuitCoal ke #GoingRenewable
                    </div>
                    <div class="text-gray-700 text-sm leading-relaxed">
                        Segera berhenti dari ketergantungan energi fosil dan beralih transisi ke energi terbarukan
                    </div>
                </div>

                <div class="lg:mt-[52px]">
                    <div class="text-red-600 text-xs mb-2">Data</div>
                    <div class="text-blue-700 font-bold text-lg leading-snug mb-4">
                        Lebih dari 80% konsumsi batu bara dalam negeri untuk PLTU
                    </div>
                    <div class="text-gray-700 text-sm leading-relaxed">
                        Konsumsi batu bara Indonesia tersedot hampir keseluruhannya ke sektor industri pembangkit
                        listrik
                    </div>
                </div>

                <div>
                    <div class="mb-4">
                        <div class="text-blue-700 font-bold text-sm mb-2">
                            KALENDER
                        </div>
                        <div class="h-[3px] bg-red-700 w-full"></div>
                    </div>

                    <div class="border border-gray-200">
                        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
                            <div class="text-sm font-semibold text-gray-900" id="calendarMonth"></div>
                        </div>

                        <div
                            class="grid grid-cols-7 text-center text-[10px] font-semibold text-gray-500 border-b border-gray-200">
                            <div class="py-2">Min</div>
                            <div class="py-2">Sen</div>
                            <div class="py-2">Sel</div>
                            <div class="py-2">Rab</div>
                            <div class="py-2">Kam</div>
                            <div class="py-2">Jum</div>
                            <div class="py-2">Sab</div>
                        </div>

                        <div class="grid grid-cols-7 text-center text-xs" id="calendarDays"></div>
                    </div>
                </div>

            </div>
        </div>

        <div class="space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-14">

                <div class="lg:mt-[52px]">
                    <div class="text-red-600 text-xs mb-2">Rekomendasi</div>
                    <div class="text-blue-700 font-bold text-lg leading-snug mb-4">
                        Dari #QuitCoal ke #GoingRenewable
                    </div>
                    <div class="text-gray-700 text-sm leading-relaxed">
                        Segera berhenti dari ketergantungan energi fosil dan beralih transisi ke energi terbarukan
                    </div>
                </div>

                <div class="lg:mt-[52px]">
                    <div class="text-red-600 text-xs mb-2">Data</div>
                    <div class="text-blue-700 font-bold text-lg leading-snug mb-4">
                        Lebih dari 80% konsumsi batu bara dalam negeri untuk PLTU
                    </div>
                    <div class="text-gray-700 text-sm leading-relaxed">
                        Konsumsi batu bara Indonesia tersedot hampir keseluruhannya ke sektor industri pembangkit
                        listrik
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-3">
                        <div class="text-blue-700 font-bold text-sm">
                            AKTIVITAS
                        </div>
                        <a href="#" class="text-xs font-semibold text-blue-700 hover:underline">
                            See more >>
                        </a>
                    </div>

                    <div class="h-[3px] bg-red-700 w-full mb-4"></div>

                    <div class="space-y-4">
                        <div class="border-b pb-2">
                            <div class="text-red-600 text-xs mb-2">
                                29-Jun-22 || #Aktivitas
                            </div>
                            <div class="text-gray-700 text-sm leading-relaxed">
                                SPN Dari Tambang: Eksploitasi atau Perspektif Jangka Panjang?
                            </div>
                        </div>

                        <div class="border-b pb-2">
                            <div class="text-red-700 font-semibold text-xs mb-1">
                                29-Jun-22 || #Aktivitas
                            </div>
                            <div class="text-black font-semibold text-sm leading-snug">
                                PSN: Deforestasi Terencana dan Potret Lingkungan
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function () {

                const monthNames = [
                    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                ];

                const now = new Date();
                const year = now.getFullYear();
                const month = now.getMonth();
                const today = now.getDate();

                const firstDay = new Date(year, month, 1).getDay();
                const totalDays = new Date(year, month + 1, 0).getDate();

                document.getElementById("calendarMonth").innerText = monthNames[month] + " " + year;

                let html = "";

                for (let i = 0; i < firstDay; i++) {
                    html += `<div class="py-2 text-gray-300">.</div>`;
                }

                for (let d = 1; d <= totalDays; d++) {
                    const isToday = d === today;

                    html += `
                <div class="py-2">
                    <div class="mx-auto w-7 h-7 flex items-center justify-center ${isToday ? 'bg-red-600 text-white font-bold' : 'text-gray-800'}">
                        ${d}
                    </div>
                </div>
            `;
                }

                document.getElementById("calendarDays").innerHTML = html;

            });
        </script>
    @endpush

    <div class="relative left-1/2 -translate-x-1/2 w-screen bg-gray-400 py-12 lg:py-16">

        <div class="max-w-5xl mx-auto px-4 lg:px-0">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:items-center">


                <div class="lg:col-span-8">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-stretch">


                        <div class="w-full aspect-[16/9] overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1529336953121-a0c8c0e3e4d3"
                                class="w-full h-full object-cover">
                        </div>


                        <div class="text-white flex flex-col h-full">

                            <div>
                                <div class="text-lg md:text-xl font-semibold mb-4 leading-tight">
                                    Pulau-pulau Kecil vs Ekspansi Nikel:
                                    Belajar dari Gebe
                                </div>

                                <div class="text-sm md:text-base opacity-90 mb-4">
                                    29 Agustus 2024
                                    <span class="mx-2">|</span>
                                    Pertambangan nikel kini menguasai nyaris separuh dari luas daratan Pulau Gebe.
                                </div>
                            </div>

                            <div class="text-sm tracking-wide mt-auto">
                                VIEW →
                            </div>

                        </div>

                    </div>

                </div>


                <div class="lg:col-span-4 flex flex-col gap-8 text-white">


                    <div class="w-full sm:max-w-[240px] lg:max-w-xl mx-auto lg:mx-0">
                        <div class="w-full aspect-[16/9] overflow-hidden mb-2">
                            <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee"
                                class="w-full h-full object-cover">
                        </div>

                        <div class="text-xs md:text-sm font-semibold mb-1 leading-snug">
                            Ancaman Keberlangsungan Biodiversitas Laut Pesisir
                        </div>

                        <div class="text-[11px] md:text-xs opacity-80">
                            Di balik statistik ekspor nikel yang meningkat...
                        </div>
                    </div>


                    <div class="w-full sm:max-w-[240px] lg:max-w-xl mx-auto lg:mx-0">
                        <div class="w-full aspect-[16/9] overflow-hidden mb-2">
                            <img src="https://images.unsplash.com/photo-1492724441997-5dc865305da7"
                                class="w-full h-full object-cover">
                        </div>

                        <div class="text-xs md:text-sm font-semibold mb-1 leading-snug">
                            PSN: Deforestasi Terencana dan Potret Lingkungan
                        </div>

                        <div class="text-[11px] md:text-xs opacity-80">
                            Sumbangsih PSN dalam menambah luas deforestasi...
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>