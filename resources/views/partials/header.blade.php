<header class="sticky top-0 z-40 w-full border-b bg-white dark:border-gray-700 dark:bg-gray-900">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2">
            <a href="/" class="text-xl font-bold text-gray-900 dark:text-white">
                {{ config('app.name') }}
            </a>
        </div>

        <div class="flex items-center gap-4">
            <div class="relative">
                <form wire:submit.prevent="updatedSearch">
                    <input
                        type="search"
                        wire:model.live="search"
                        placeholder="Поиск товаров..."
                        class="rounded-lg border-gray-300 px-4 py-2 text-sm shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white"
                    >
                </form>

                @if($search)
                    <button
                        wire:click="$set('search', '')"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </button>
                @endif
            </div>

            <x-filament::button
                tag="a"
                href="{{ url('/admin/login') }}"
                icon="heroicon-o-user"
                color="gray"
            >
                Личный кабинет
            </x-filament::button>
        </div>
    </div>
</header>
