<x-user-layout>
    <x-slot name="title">
        {{ $posts->title }}
    </x-slot>
    <!-- Post Content -->
    <div class="container mx-auto px-4 py-4 lg:max-w-4xl">
        <div class="bg-white shadow-md rounded-lg dark:bg-neutral-900 overflow-hidden">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white px-6 py-4 border-b dark:border-neutral-700">
                {{ $posts->title }}
            </h3>
            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 px-6 py-2">
                <svg class="w-4 h-4 mr-1 fill-current" viewBox="0 0 512 512">
                    <path d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/>
                </svg>
                <span>{{ $posts->updated_at->format('H:i d/m/Y') }}</span>
            </div>

            <!-- Content -->
            <div class="p-6">
                <p class="text-gray-700 dark:text-neutral-400 mb-4">
                    {{ $posts->summary }}
                </p>

                <div class="text-gray-600 dark:text-neutral-400">
                    {!! $posts->content !!}
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
