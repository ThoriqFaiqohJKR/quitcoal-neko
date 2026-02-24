<nav x-data="{ mobileOpen:false, open:null, lang:'EN | ID' }">
    <div class="bg-white shadow-md fixed w-full z-30">
        <div class="lg:max-w-6xl mx-auto h-20 flex items-center justify-between">
            <!-- MOBILE BAR: Hamburger — Logo — EN | ID -->
            <div class=" md:hidden flex items-center justify-between w-full h-15 px-4">
                <div class="relative md:hidden flex items-center w-full h-15">
                    <button @click="mobileOpen = true" class="p-2 border absolute left-0" aria-label="Open menu">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <div class="w-auto mx-auto">
                        <a href="{{ '/' . app()->getLocale() }}">
                            <img src="{{ asset('img/logos/logo.png') }}" alt="Logo Auriga"
                                class="h-12 w-auto mx-auto" />
                        </a>
                    </div>


                    <div class="absolute right-0">
                        <div class="inline-flex items-center rounded-full border p-0.5">
                            <a href="{{ url('en' . (count(request()->segments()) > 1 ? '/' . implode('/', array_slice(request()->segments(), 1)) : '')) }}{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}"
                                class="px-2 py-1 rounded-full text-xs font-medium {{ request()->segment(1) === 'en' ? 'bg-green-600 text-white' : 'text-slate-700 hover:bg-green-50' }}">EN</a>
                            <a href="{{ url('id' . (count(request()->segments()) > 1 ? '/' . implode('/', array_slice(request()->segments(), 1)) : '')) }}{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}"
                                class="px-2 py-1 rounded-full text-xs font-medium {{ request()->segment(1) === 'id' ? 'bg-green-600 text-white' : 'text-slate-700 hover:bg-green-50' }}">ID</a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- DESKTOP BAR (unchanged layout) -->
            <div class="hidden md:flex items-stretch justify-between w-full h-full poppins-regular"
                x-data="{ desktopOpen:null }">
                <!-- Logo & Menu -->
                <div class="flex items-center justify-between h-full gap-16 w-full ">
                    <!-- Logo -->
                    <div class="flex items-center h-full">
                        <a href="{{ '/' . app()->getLocale() }}">
                            <img src="{{asset('img/logos/logo.png') }}" alt="Logo Auriga"
                                class="h-14 w-auto object-contain" />
                        </a>
                    </div>


                    <div class="hidden md:flex gap-8 text-sm tracking-wide px-8">

                        <div class="relative hover:text-blue-400">
                            <a href="{{ route('about') }}">
                                {{ __('Tentang') }}
                            </a>
                        </div>


                        <div class="relative">
                            <button @click="desktopOpen = desktopOpen === 'background' ? null : 'background'"
                                class="hover:text-blue-900 flex items-center focus:outline-none cursor-pointer">
                                {{ __('Latar Belakang') }}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-5 h-5 ml-1 transition-transform duration-200"
                                    :class="desktopOpen === 'background' ? 'rotate-180' : ''">
                                    <path fill-rule="evenodd"
                                        d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="desktopOpen === 'background'" x-cloak @click.outside="desktopOpen = null"
                                class="absolute left-0 mt-2 min-w-max bg-white shadow-lg z-50">

                                <ul class="text-sm">
                                    <li class="px-4 py-2 hover:bg-gray-100 hover:text-blue-400">
                                        <a href="{{ route('background.coal-crowd') }}">{{ __('Kelompok Batubara') }}</a>
                                    </li>
                                    <li class="px-4 py-2 hover:bg-gray-100 hover:text-blue-400">
                                        <a href="{{ route('background.coal-permit') }}">{{ __('Izin Batubara') }}</a>
                                    </li>
                                    <li class="px-4 py-2 hover:bg-gray-100 hover:text-blue-400">
                                        <a href="{{ route('background.regulation') }}">{{ __('Peraturan') }}</a>
                                    </li>
                                    <li class="px-4 py-2 hover:bg-gray-100 hover:text-blue-400">
                                        <a href="{{ route('background.benchmark-price') }}">{{ __('Harga Patokan') }}</a>
                                    </li>
                                    <li class="px-4 py-2 hover:bg-gray-100 hover:text-blue-400">
                                        <a href="{{ route('background.coal-production') }}">{{ __('Produksi Batubara') }}</a>
                                    </li>
                                    <li class="px-4 py-2 hover:bg-gray-100 hover:text-blue-400">
                                        <a href="{{ route('background.coal-consumption') }}">{{ __('Konsumsi Batubara') }}</a>
                                    </li>
                                    <li class="px-4 py-2 hover:bg-gray-100 hover:text-blue-400">
                                        <a href="{{ route('background.mining-and-deforestation') }}">{{ __('Pertambangan dan Deforestasi') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>


                        <div class="relative">
                            <button @click="desktopOpen = desktopOpen === 'coalruption' ? null : 'coalruption'"
                                class="hover:text-blue-900 flex items-center focus:outline-none cursor-pointer">

                               {{ __('Coal-Ruption') }}

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-5 h-5 ml-1 transition-transform duration-200"
                                    :class="desktopOpen === 'coalruption' ? 'rotate-180' : ''">
                                    <path fill-rule="evenodd"
                                        d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="desktopOpen === 'coalruption'" x-cloak @click.outside="desktopOpen = null"
                                class="absolute left-0 mt-2 w-40 bg-white shadow-lg z-50">

                                <ul class="text-sm">
                                    <li class="px-4 py-2 hover:bg-gray-100 hover:text-blue-400">
                                        <a href="{{ route('coal-ruption.cases') }}">{{ __('Kasus') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>



                        <div class="relative hover:text-blue-400">
                            <a href="{{ route('action.index')   }}">
                                {{ __('Aksi') }}
                            </a>
                        </div>



                        <div class="relative">
                            <button @click="desktopOpen = desktopOpen === 'data' ? null : 'data'"
                                class="hover:text-blue-900 flex items-center focus:outline-none cursor-pointer">

                                {{ __('Data') }}

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-5 h-5 ml-1 transition-transform duration-200"
                                    :class="desktopOpen === 'data' ? 'rotate-180' : ''">
                                    <path fill-rule="evenodd"
                                        d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="desktopOpen === 'data'" x-cloak @click.outside="desktopOpen = null"
                                class="absolute left-0 mt-2 w-40 bg-white shadow-lg z-50">

                                <ul class="text-sm">
                                    <li class="px-4 py-2 hover:bg-gray-100 hover:text-blue-400">
                                        <a href="{{ route('data.resource.index') }}">{{ __('Sumber Daya') }}</a>
                                    </li>
                                    <li class="px-4 py-2 hover:bg-gray-100 hover:text-blue-400">
                                        <a href="{{ route('data.check-pltu.index') }}">{{ __('Periksa PLTU') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Language & Search (desktop only) -->
                <div class="hidden md:flex items-center gap-8 border-l border-slate-300 pl-10 h-full">
                    {{-- DESKTOP: language switch --}}
                    <div x-data="{ open:false }" class="relative">
                        <button @click="open = !open"
                            class="flex items-center gap-1 text-sm cursor-pointer hover:text-green-900 focus:outline-none">
                            <span class="uppercase tracking-wide">
                                {{ request()->segment(1) === 'id' ? 'INDONESIA' : 'ENGLISH' }}
                            </span>
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06L10 14.59 5.23 8.27z" />
                            </svg>
                        </button>

                        <div x-show="open" x-cloak @click.outside="open=false"
                            class="absolute left-0 mt-2 w-40 bg-white border shadow-lg z-50">
                            <ul class="py-1 text-sm">
                                <li>
                                    <a href="{{ url('en' . (count(request()->segments()) > 1 ? '/' . implode('/', array_slice(request()->segments(), 1)) : '')) }}{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}"
                                        class="block px-4 py-2 hover:bg-gray-100 {{ request()->segment(1) === 'en' ? 'font-bold text-green-900' : 'text-slate-700' }}">
                                        ENGLISH
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('id' . (count(request()->segments()) > 1 ? '/' . implode('/', array_slice(request()->segments(), 1)) : '')) }}{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}"
                                        class="block px-4 py-2 hover:bg-gray-100 {{ request()->segment(1) === 'id' ? 'font-bold text-green-900' : 'text-slate-700' }}">
                                        INDONESIA
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>


                    <div class="flex items-center gap-2 text-sm cursor-pointer hover:text-green-900 h-full">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="7" stroke-width="2"></circle>
                            <path d="M20 20l-3.5-3.5" stroke-width="2" stroke-linecap="round"></path>
                        </svg>
                        <span>{{ __('Cari') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- MOBILE DRAWER (menu + search) -->
    <div x-show="mobileOpen" x-transition class="md:hidden fixed inset-0 z-40">
        <div class="absolute inset-0 bg-black/50" @click="mobileOpen=false"></div>
        <div class="absolute left-0 top-0 h-full w-72 max-w-[85%] bg-white shadow-xl p-5 overflow-y-auto"
            x-data="{ openMenus: [] }">
            <div class="flex items-center justify-end mb-4">
                <button @click="mobileOpen=false" class="p-2" aria-label="Close">✕</button>
            </div>
            <!-- Search input -->
            <label class="block mb-4">
                <div class="flex items-center gap-2 border   px-3 py-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="7" stroke-width="2"></circle>
                        <path d="M20 20l-3.5-3.5" stroke-width="2" stroke-linecap="round"></path>
                    </svg>
                    <input type="text" placeholder="Search..." class="w-full text-sm focus:outline-none" />
                </div>
            </label>
            <!-- Menu Mobile -->
            <ul class="space-y-3">
                <a href="{{ route('about') }}" class="block font-medium py-2">
                    {{ __('Tentang') }}
                </a>

                <div x-data="{ open:false }">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between text-left font-medium py-2">

                        <span>{{ __('Latar Belakang') }}</span>

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 transform transition-transform duration-200"
                            :class="open ? 'rotate-180' : 'rotate-0'" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <ul x-show="open" x-transition class="pl-4 text-sm space-y-1">
                        <li><a href="#" class="block py-1">{{ __('Kelompok Batubara') }}</a></li>
                        <li><a href="#" class="block py-1">{{ __('Izin Batubara') }}</a></li>
                        <li><a href="#" class="block py-1">{{ __('Peraturan') }}</a></li>
                        <li><a href="#" class="block py-1">{{ __('Harga Patokan') }}</a></li>
                        <li><a href="#" class="block py-1">{{ __('Produksi Batubara') }}</a></li>
                        <li><a href="#" class="block py-1">{{ __('Konsumsi Batubara') }}</a></li>
                        <li><a href="#" class="block py-1">{{ __('Mining and Deforestation') }}</a></li>
                    </ul>
                </div>

                <li x-data="{open:false}">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between text-left font-medium py-2">

                        <span>{{ __('Coal-Ruption') }}</span>


                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 transform transition-transform duration-200"
                            :class="open ? 'rotate-180' : 'rotate-0'" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <ul x-show="open" x-transition class="pl-4 text-sm space-y-1">
                        <li><a href="#" class="block py-1">{{ __('Kasus') }}</a></li>
                    </ul>
                </li>
                <a href="#" class="block font-medium py-2">
                    {{ __('Aksi') }}
                </a>
                <li x-data="{open:false}">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between text-left font-medium py-2">

                        <span>{{ __('Data') }}</span>


                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 transform transition-transform duration-200"
                            :class="open ? 'rotate-180' : 'rotate-0'" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <ul x-show="open" x-transition class="pl-4 text-sm space-y-1">
                        <li><a href="#" class="block py-1">{{ __('Sumber Daya') }}</a></li>
                        <li><a href="#" class="block py-1">{{ __('Periksa PLTU') }}</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>