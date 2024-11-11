<x-admin-layout>
    <x-slot name="title">
        Thêm Posts
    </x-slot>
    <div>
        <div class="font-bold text-2xl text-center">Thêm Posts</div>
        <div class="flex flex-col mt-5">
            <div class="-m-1.5 overflow-x-auto [&::-webkit-scrollbar]:h-1 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-blue-300">
                <form id="postForm" action="{{route('admin.posts.store')}}" method="POST" class="md:w-4/5 w-full mx-5 md:m-auto border-2 py-4 px-10 rounded-lg" enctype="multipart/form-data">
                    @csrf
                    <div class="pb-7">
                        <div class="mt-7">
                            <label for="title" class="block text-sm mb-2 font-semibold ">Tiêu đề</label>
                            <div class="flex rounded-lg">
                                <input id="title" name="title" onkeyup="ChangeToSlug()" class="p-2 block w-full border-2 border-blue-200 focus:border-blue-200 focus:ring-2 outline-none rounded-lg" placeholder="Nhập tiêu đề">
                            </div>
                        </div>
                        <div class="mt-7">
                            <label for="slug" class="block text-sm mb-2 font-semibold">Slug</label>
                            <div class="flex rounded-lg">
                                <input id="slug" name="slug" class="p-2 block w-full border-2 border-blue-200 focus:border-blue-200 focus:ring-2 outline-none rounded-lg " readonly>
                            </div>
                        </div>
                        <div class="mt-7">
                            <label for="summary" class="block text-sm mb-2 font-semibold">Tóm tắt</label>
                            <div class="flex rounded-lg">
                                <input id="summary" name="summary" class="p-2 block w-full border-2 border-blue-200 focus:border-blue-200 focus:ring-2 outline-none rounded-lg" placeholder="Tóm tắt">
                            </div>
                        </div>
                        <div class="mt-7">
                            <label for="image" class="block text-sm mb-2 font-semibold">Hình ảnh</label>
                            <div class="relative">
                                <input type="file" name="image" id="input-image" class="hidden">
                                <div id="image-preview-contain" class="w-96 h-64 flex cursor-pointer ">
                                    <svg id="icon-upload" class="w-48 h-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                        <path d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128l-368 0zm79-217c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39L296 392c0 13.3 10.7 24 24 24s24-10.7 24-24l0-134.1 39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0l-80 80z"/></svg>
                                    <img id="image-preview" class="w-full h-full object-cover rounded-lg hidden" src="" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="mt-7">
                            <label for="content" class="block text-sm mb-2 font-semibold">Nội dung</label>
                            <textarea id="content" name="content"></textarea>
                        </div>
                        <div class="mt-7">
                            <label for="status" class="block text-sm font-semibold">Trạng thái</label>
                            <div class="flex gap-x-6 rounded-lg h-12">
                                <div class="flex items-center">
                                    <input type="radio" name="status" value="0" class="w-5 h-5" id="display">
                                    <label for="display" class="ms-2">Hiển thị</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" name="status" value="1" class=" w-5 h-5" id="hidden">
                                    <label for="hidden" class="ms-2">Ẩn</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center mt-7">
                        <button id="createpost" type="submit" class="py-3 px-4 w-36 mb-5 inline-flex justify-center font-bold items-center gap-x-2 rounded-full border border-transparent bg-green-500 text-white hover:bg-green-700 cursor-pointer">
                            Tạo Post
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <x-slot name="script">
        <script type="module">
            CKEDITOR.replace('content' , {
                height : 500,
                toolbar: [
                    '/',
                    ['Bold', 'Italic', 'Underline', 'StrikeThrough', '-', 'Undo', 'Redo', '-', 'Cut', 'Copy', 'Paste', 'Find', 'Replace', '-', 'Outdent', 'Indent', '-', 'Print'],
                    '/',
                    ['NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
                    ['FontSize', 'Image', 'Table', '-', 'Link', 'Flash', 'Smiley', 'TextColor', 'BGColor', 'Source']
                ],
                fontSize_sizes: '12/12px;14/14px;16/16px;18/18px;24/24px;36/36px;48/48px;'
            });
        </script>
    </x-slot>
</x-admin-layout>
