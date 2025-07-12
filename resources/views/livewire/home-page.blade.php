<div>
    <section class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        @if($search)
            <div class="mb-4">
                <p class="text-gray-600 dark:text-gray-300">
                    @if($products->isEmpty())
                        По вашему запросу "<span class="font-semibold">{{ $search }}</span>" ничего не найдено
                    @else
                        Результаты поиска по запросу: "<span class="font-semibold">{{ $search }}</span>"
                    @endif
                </p>
            </div>
        @endif

        @if($products->isEmpty())
            <x-filament::card>
                <div class="p-6 text-center">
                    <p class="text-gray-500 dark:text-gray-400">
                        @if($search)
                            Попробуйте изменить параметры поиска
                        @else
                            Товары не найдены
                        @endif
                    </p>
                </div>
            </x-filament::card>
        @else
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach($products as $product)
                <x-filament::card class="overflow-hidden">
                    <a href="{{ route('product.show', $product) }}" class="block">
                        @if($product->main_image)
                            <div class="relative h-48 w-full overflow-hidden rounded-t-lg bg-gray-100">
                                <img src="{{ asset('storage/'.$product->main_image) }}"
                                     alt="{{ $product->title }}"
                                     class="h-full w-full object-cover object-center"
                                     loading="lazy">
                            </div>
                        @endif

                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                {{ $product->title }}
                            </h3>

                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 line-clamp-3">
                                {{ $product->description }}
                            </p>

                            <div class="mt-4 flex items-center justify-between">
                            </div>
                        </div>
                    </a>
                </x-filament::card>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $products->links() }}
        </div>
    @endif
</section>
</div>
