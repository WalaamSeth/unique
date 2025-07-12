<header class="sticky top-0 z-40 w-full border-b bg-white dark:border-gray-700 dark:bg-gray-900">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2">
            <span class="text-xl font-bold text-gray-900 dark:text-white">
                {{ config('app.name') }}
            </span>
        </div>

        <div class="flex items-center gap-4">
            <div class="relative">
                <input
                    type="search"
                    wire:model.live.debounce.500ms="search"
                    placeholder="Поиск товаров..."
                    class="rounded-lg border-gray-300 px-4 py-2 text-sm shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white"
                >
            </div>

            <a
                href="{{ url('/admin/login') }}"
                class="inline-flex items-center gap-2 rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600"
            >
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Личный кабинет
            </a>
        </div>
    </div>
</header>
