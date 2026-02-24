<div class="max-w-5xl mx-auto px-4 py-10">

    {{-- Header --}}
    <div class="mb-10">
        <h1 class="text-3xl font-bold text-gray-900">
            Coal Crowd
        </h1>
    </div>

    {{-- Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        @forelse($data as $item)
            <div class="border-b pb-6 h-full flex flex-col">

                {{-- Title --}}
                <h2 class="text-lg font-semibold text-gray-900 leading-snug line-clamp-2">
                    {{ strip_tags($item->title_id) }}
                </h2>

                {{-- Desc --}}
                <div class="text-sm text-gray-700 mt-3 leading-relaxed line-clamp-3 [&_p]:inline">
                    {!! $item->deskripsi_id !!}
                </div>

                {{-- Footer --}}
                <div class="mt-auto pt-4 text-sm text-gray-500">
                    <div class="flex items-center gap-2 [&_p]:inline [&_a]:text-red-600 [&_a]:font-medium [&_a:hover]:underline">
                        <span class="font-medium text-gray-700">Sumber:</span>

                        {!! $item->sumber !!}

                        <span class="text-gray-400">|</span>

                        <span>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</span>
                    </div>
                </div>

            </div>
        @empty
            <div class="col-span-2 text-center text-gray-500 py-10">
                Data Coal Crowd belum tersedia.
            </div>
        @endforelse

    </div>

    {{-- Pagination custom --}}
    @if($lastPage > 1)
        <div class="mt-10">
            @include('components.pagination', [
                'page' => $page,
                'lastPage' => $lastPage
            ])
        </div>
    @endif

</div>
