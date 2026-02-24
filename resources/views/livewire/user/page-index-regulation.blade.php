<div class="max-w-3xl mx-auto py-10 px-10">

    @forelse($regulations as $item)

        <div class="mb-10 border-b pb-10">

            <div class="prose text-2xl font-bold mb-6 max-w-none">
                {!! app()->getLocale() === 'id'
                    ? $item->title_id
                    : $item->title_en
                !!}
            </div>

            @if(!empty($item->image))
                <div class="mb-6">
                    <img
                        src="{{ $item->image }}"
                        alt="Regulation image"
                        class="w-full max-w-xl border"
                    >
                </div>
            @endif

            <div class="prose max-w-none leading-snug">
                {!! app()->getLocale() === 'id'
                    ? $item->deskripsi_id
                    : $item->deskripsi_en
                !!}
            </div>

        </div>

    @empty
        <div class="text-gray-500">
            Data regulation belum tersedia.
        </div>
    @endforelse

</div>
