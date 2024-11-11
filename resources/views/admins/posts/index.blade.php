<x-admin-layout>
    <x-slot name="title">
        Quản lý Posts
    </x-slot>
    <div>
        <div class="font-bold text-2xl">Quản lý Posts</div>
        <div class="flex flex-col mt-5">
            <div class="-m-1.5 overflow-x-auto [&::-webkit-scrollbar]:h-1 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-blue-300">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="flex my-2">
                        <a href="{{ route('admin.posts.create') }}" class="flex p-2 bg-blue-300 rounded text-blue-800 font-semiboldbold">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-5 h-5 fill-current text-blue-800">
                                <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
                            Bài viết mới
                        </a>
                    </div>
                    <div class="">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-300">
                            <tr>
                                <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th scope="col" class="px-2 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tiêu đề</th>
                                <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">Hình ảnh</th>
                                <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">Tóm tắt</th>
                                <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                                <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">Ngày tạo</th>
                                <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">Hành động</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            @foreach($posts as $post)
                                <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100">
                                    <td class="px-2 py-3 whitespace-nowrap text-center text-sm font-medium text-gray-800">#{{ $post->id }}</td>
                                    <td class="px-2 py-3 text-sm text-gray-800">
                                        <div class="max-w-44 line-clamp-1" title="{{ $post->title }}">{{ $post->title }}</div>
                                    </td>
                                    <td>
                                        <div class="flex items-center justify-center">
                                            <div>
                                                <img class="flex items-center justify-center w-[200px] h-[100px] border bg-gray-600 rounded" src="{{ Storage::url($post->image->path) }}" alt="">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-2 py-3 text-sm text-gray-800">
                                        <div class="max-w-44 line-clamp-1">{{$post->summary }}</div>
                                    </td>
                                    <td class="px-2 py-3 whitespace-nowrap text-center text-sm text-gray-800">
                                        @switch($post->status)
                                            @case('1')
                                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs bg-gray-200 text-gray-800">Ẩn</span>
                                                @break
                                            @default
                                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs bg-green-200 text-green-800">Hiển thị</span>
                                        @endswitch
                                    </td>
                                    <td class="px-2 py-3 whitespace-nowrap text-center text-sm text-gray-800">{{ date_format($post->created_at, 'd/m/Y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.posts.edit', $post->slug) }}" class="py-2 px-3 border rounded-lg bg-blue-300 text-blue-700">Sửa</a>
                                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="py-2 px-3 border rounded-lg bg-red-300 text-red-700" onclick="return confirm('Bạn có chắc chắn muốn xóa post này?')">Xoá</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
{{--                {{ $posts->links('layouts.pagination', ['role' => 'user']) }}--}}
            </div>
        </div>
    </div>
</x-admin-layout>
