<x-user-layout>
    <x-slot name="title">
        Daily Weather
    </x-slot>

    <div class="container mx-auto mt-8">
        <!-- Header -->
        <h1 class="text-2xl font-bold mb-4">Thời tiết hằng ngày</h1>
        <section class="py-10 lg:py-24">
            <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts as $post)
                    <!-- Post Card -->
                    <div class="bg-white overflow-hidden group relative">
                        <!-- Post Image Wrapper with Overlay -->
                        <div class="relative overflow-hidden">
                            <img src="{{ Storage::url($post->image->path) }}" alt="Post Image" class="w-full h-72 object-cover transform scale-110 transition-transform duration-300 group-hover:scale-100">

                            <!-- Dark Overlay -->
                            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>

                            <!-- Date Badge -->
                            <div class="absolute top-4 left-4 bg-amber-500 text-white px-4 py-1 rounded-full text-sm flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 mr-1 fill-current">
                                    <path d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/>
                                </svg>
                                {{ $post->updated_at->format('d, M Y') }}
                            </div>
                        </div>
                        <!-- Post Content -->
                        <div class="py-3">
                            <h2 class="text-2xl font-bold mb-2 mx-4 transition-colors duration-300 hover:text-amber-500">{{ $post->title }}</h2>
                            <p class="text-gray-600 mb-4 mx-4">{{ $post->summary }}</p>
                            <a href="{{ route('post.show', ['slug' => $post->slug]) }}" class="inline-block px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-full transition-all duration-300">
                                Đọc thêm
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</x-user-layout>
