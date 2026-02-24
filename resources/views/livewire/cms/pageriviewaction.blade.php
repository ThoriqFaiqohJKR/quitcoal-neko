<div>
    <div class="w-screen relative left-1/2 -translate-x-1/2 h-125 md:hmd:h-162.5gray-200 overflow-hidden">
        @if(!empty($item['flyer']))
            <img src="{{ asset('storage/' . $item['flyer']) }}"
                alt="{{ $item['title'] }}"
                class="w-full h-full object-cover object-center" />
        @else
            <div class="w-full h-full flex items-center justify-center text-gray-500 text-sm">
                No flyer
            </div>
        @endif
    </div>
 
    
    <div class="px-4 sm:px-6 lg:max-w-4xl mx-auto ">

        <div class="text-3xl sm:text-4xl md:text-5xl font-bold text-center leading-tight mb-8">
            {{ $item['title'] }}
        </div>

        

        <div class="prose max-w-none text-gray-700 leading-relaxed">
            {!! $item['content'] !!}
        </div>

    </div>

</div>
