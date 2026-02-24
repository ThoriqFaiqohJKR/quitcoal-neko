<div class="max-w-2xl mx-auto py-10 px-10">

    @if($about)

        <h1 class="text-2xl font-bold mb-6">
            {{ app()->getLocale() === 'id'
                ? $about->title_id
                : $about->title_en
            }}
        </h1>

        @if(!empty($about->image))
            <div class="mb-6">
                <img
                    src="{{ $about->image }}"
                    alt="About image"
                    class="w-full max-w-xl"
                >
            </div>
        @endif

        <div class="prose max-w-none leading-snug">
            {!! app()->getLocale() === 'id'
                ? $about->content_id
                : $about->content_en
            !!}
        </div>

    @else
        <div class="text-gray-500">
            Data about belum tersedia.
        </div>
    @endif

</div>
