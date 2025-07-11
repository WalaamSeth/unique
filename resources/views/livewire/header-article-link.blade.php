<div class="fi-topbar-item">
    <a
        href="{{ $url }}"
        @class([
            'fi-topbar-item-button flex items-center gap-x-2 rounded-lg px-3 py-2 text-sm font-medium outline-none transition duration-75',
            'text-gray-700 hover:bg-gray-50 hover:text-gray-900 focus:bg-gray-50 dark:text-gray-200 dark:hover:bg-white/5 dark:hover:text-white dark:focus:bg-white/5' => ! str_starts_with($url, request()->url()),
            'bg-gray-50 text-primary-600 dark:bg-white/5 dark:text-primary-400' => str_starts_with($url, request()->url()),
        ])
        wire:navigate
    >
        <x-dynamic-component
            :component="$icon"
            @class([
                'fi-topbar-item-icon h-5 w-5',
                'text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-400' => ! str_starts_with($url, request()->url()),
                'text-primary-600 dark:text-primary-400' => str_starts_with($url, request()->url()),
            ])
        />

        <span class="fi-topbar-item-label">
            {{ $label }}
        </span>
    </a>
</div>
