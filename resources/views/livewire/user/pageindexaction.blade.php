<div class="max-w-5xl mx-auto">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach($actions as $item)
            <a href="{{ url(app()->getLocale() . '/action/' . $item->id . '/' . $item->slug) }}"
                class="border block bg-white overflow-hidden hover:shadow-lg transition max-w-sm">


                <div class="w-full max-h-50 bg-gray-100 overflow-hidden">
                    <img src="{{ asset('storage/' . $item->flyer) }}" class="w-full h-full object-cover" alt="flyer">
                </div>

                <div class="bg-black text-white p-4 max-h-35 overflow-hidden">

                    <div class="text-lg font-bold leading-snug line-clamp-2">
                        {{ $item->judul ?? '-' }}
                    </div>

                    <div class="text-xs text-gray-200 mt-3 leading-relaxed prose prose-invert max-w-none line-clamp-3">
                        {!! $item->deskripsi ?? '-' !!}
                    </div>

                </div>

            </a>
        @endforeach

    </div>

    @if ($lastPage > 1)
        <div class="mt-10 flex justify-center">
            @include('components.pagination')
        </div>
    @endif

</div>