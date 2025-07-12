@extends('layouts.app')

@section('content')
    <x-filament::card class="overflow-hidden">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- Блок с изображениями -->
            <div>
                <!-- Главное изображение -->
                <div class="relative h-96 w-full overflow-hidden rounded-lg bg-gray-100">
                    <img src="{{ asset('storage/'.$product->main_image) }}"
                         alt="{{ $product->title }}"
                         class="h-full w-full object-contain object-center">
                </div>

                <!-- Дополнительные изображения -->
                @if($product->additional_images && count($product->additional_images) > 0)
                    <x-filament::card class="mt-4 p-4">
                        <h2 class="mb-3 text-lg font-medium text-gray-900 dark:text-white">
                            Дополнительные фото
                        </h2>
                        <div class="grid grid-cols-3 gap-3">
                            @foreach($product->additional_images as $image)
                                <div class="relative h-24 overflow-hidden rounded-md bg-gray-100">
                                    <img src="{{ asset('storage/'.$image) }}"
                                         alt="Дополнительное фото {{ $loop->iteration }}"
                                         class="h-full w-full object-cover object-center">
                                </div>
                            @endforeach
                        </div>
                    </x-filament::card>
                @endif
            </div>

            <!-- Информация о товаре -->
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ $product->title }}
                </h1>

                <div class="mt-4 flex items-center space-x-4">
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        Добавлено: {{ $product->created_at->format('d.m.Y') }}
                    </span>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">
                        {{ $product->user->name }}
                    </span>
                </div>

                <div class="mt-6">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">
                        Описание
                    </h2>
                    <p class="mt-2 text-gray-600 dark:text-gray-300 whitespace-pre-line">
                        {{ $product->description }}
                    </p>
                </div>

                <!-- Категории -->
                @if($product->categories->isNotEmpty())
                    <div class="mt-6">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-white">
                            Категории
                        </h2>
                        <div class="mt-2 flex flex-wrap gap-2">
                            @foreach($product->categories as $category)
                                <span class="inline-flex items-center rounded-full bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Кнопка "Назад" -->
                <div class="mt-8">
                    <a href="{{ url()->previous() }}"
                       class="inline-flex items-center text-sm font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300">
                        ← Вернуться к списку товаров
                    </a>
                </div>
            </div>
        </div>
    </x-filament::card>
@endsection
