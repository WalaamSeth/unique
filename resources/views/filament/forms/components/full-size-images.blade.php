<div>
    @foreach ($getState() as $image)
        <div class="my-4">
            <img
                src="{{ Storage::url($image) }}"
                alt="Изображение статьи"
                class="rounded-lg w-full max-h-96 object-contain"
            >
        </div>
    @endforeach
</div>
