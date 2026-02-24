<div class="max-w-2xl mx-auto py-10 px-10">

    @if($background)

        <h1 class="text-2xl font-bold mb-6">
            {{ app()->getLocale() === 'id'
                ? $background->title_id
                : $background->title_en
            }}
        </h1>

        @if(!empty($background->image))
            <div class="mb-6">
                <img
                    src="{{ $background->image }}"
                    alt="Background image"
                    class="w-full max-w-xl"
                >
            </div>
        @endif

        <div class="prose max-w-none leading-snug">
            {!! app()->getLocale() === 'id'
                ? $background->deskripsi_id
                : $background->deskripsi_en
            !!}
        </div>

    @else
        <div class="text-gray-500">
            Data Coal Permit belum tersedia.
        </div>
    @endif

</div>
