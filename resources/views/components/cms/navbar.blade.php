<nav class="fixed top-0 left-0 w-full bg-white shadow z-50 py-2">
    <div class="container mx-auto px-6 py-4 grid grid-cols-3 items-center">

        
        <div></div>

        
        <ul class="flex justify-center gap-6 text-sm whitespace-nowrap relative">

            <li>
                <a href="{{ route('cms.index') }}" class="hover:text-blue-600 block">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('cms.about') }}" class="hover:text-blue-600 block">
                    About
                </a>
            </li>

            
            <li x-data="{ open: false }" class="relative">
                <button @click.stop="open = !open" @click.outside="open = false"
                    class="hover:text-blue-600 flex items-center gap-1">
                    Background
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <ul x-show="open" x-transition x-cloak class="absolute left-0 mt-3 w-64 bg-white border shadow-lg z-50">

                    <li><a href="{{ route('cms.background.coalcrowd.index') }}"
                            class="block px-4 py-2 hover:bg-gray-100">Coalcrowd</a></li>
                    <li><a href="{{ route('cms.background.coal-permit.index') }}"
                            class="block px-4 py-2 hover:bg-gray-100">Coal Permit</a></li>
                    <li><a href="{{ route('cms.background.regulation.index') }}"
                            class="block px-4 py-2 hover:bg-gray-100">Regulation</a></li>
                    <li><a href="{{ route('cms.background.benchmark-price.index') }}"
                            class="block px-4 py-2 hover:bg-gray-100">Benchmark Price</a></li>
                    <li><a href="{{ route('cms.background.coal-production.index') }}"
                            class="block px-4 py-2 hover:bg-gray-100">Coal Production</a></li>
                    <li><a href="{{ route('cms.background.coal-consumption.index') }}"
                            class="block px-4 py-2 hover:bg-gray-100">Coal Consumption</a></li>
                    <li><a href="{{ route('cms.background.mining-and-deforestation.index') }}"
                            class="block px-4 py-2 hover:bg-gray-100">Mining & Deforestation</a></li>
                </ul>
            </li>

            
            <li x-data="{ open: false }" class="relative">
                <button @click.stop="open = !open" @click.outside="open = false"
                    class="hover:text-blue-600 flex items-center gap-1">
                    Coal-Ruption
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <ul x-show="open" x-transition x-cloak class="absolute left-0 mt-3 w-56 bg-white border shadow-lg z-50">
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Case</a></li>
                </ul>
            </li>

            <li>
                <a href="{{ route('cms.action.index') }}" class="hover:text-blue-600 block">
                    Action
                </a>
            </li>

            
            <li x-data="{ open: false }" class="relative">
                <button @click.stop="open = !open" @click.outside="open = false"
                    class="hover:text-blue-600 flex items-center gap-1">
                    Data
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <ul x-show="open" x-transition x-cloak class="absolute left-0 mt-3 w-56 bg-white border shadow-lg z-50">
                    <li><a href="{{ route('cms.data.resource.index') }}"
                            class="block px-4 py-2 hover:bg-gray-100">Resource</a></li>
                    <li><a href="{{ route('cms.data.check-pltu.index') }}"
                            class="block px-4 py-2 hover:bg-gray-100">Check PLTU</a></li>
                </ul>
            </li>

            <li>
                <a href="{{ route('cms.account.index') }}" class="hover:text-blue-600 block">
                    Account
                </a>
            </li>

            <li>
                <a href="{{ route('cms.activity.index') }}" class="hover:text-blue-600 block">
                    Activity
                </a>
            </li>

            <li>
                <a href="{{ route('cms.ngopini.index') }}" class="hover:text-blue-600 block">
                    Ngopini
                </a>
            </li>

        </ul>

        
        <div class="flex items-center justify-end gap-4" x-data="{ openProfile: false }">

       

            <div class="relative">
                <button @click.stop="openProfile = !openProfile" class="flex items-center">
                    <img src="{{ asset('img/icon-admin.png') }}" class="w-8 h-8 object-contain">
                </button>

                <div x-show="openProfile" x-transition x-cloak @click.outside="openProfile = false"
                    class="absolute right-0 mt-3 w-44 bg-white border shadow-lg text-sm z-50">
                    <a href="{{ url('/profile') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                    <a href="#" class="block px-4 py-2 text-red-500 hover:bg-gray-100"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </div>
            </div>

        </div>

    </div>
</nav>

<form id="logout-form" action="#" method="POST" class="hidden">
    @csrf
</form>