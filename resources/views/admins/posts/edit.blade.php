<x-admin-layout>
    <x-slot name="title">
        Chỉnh sửa Post
    </x-slot>
    <div>
        <div class="font-bold text-2xl text-center"> Chỉnh sửa Post</div>
        <div class="flex flex-col mt-5">
            <div class="-m-1.5 overflow-x-auto [&::-webkit-scrollbar]:h-1 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-blue-300">
                <form id="updatePost" action="{{route('admin.posts.update', $post->id)}}" method="POST" class="md:w-4/5 md:m-auto mx-5 border-2 py-4 px-10 rounded-lg" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="pb-7">
                        <div class="mt-7">
                            <label for="title" class="block text-sm mb-2 font-semibold">Tiêu đề</label>
                            <div class="flex rounded-lg">
                                <input id="title" name="title" onkeyup="ChangeToSlug()" value="{{ $post->title }}" class="p-2 border-2 block w-full border border-blue-200 focus:border-blue-200 focus:ring-2 outline-none rounded-lg " placeholder="Nhập tiêu đề">
                            </div>
                        </div>
                        <div class="mt-7">
                            <label for="slug" class="block text-sm mb-2 font-semibold">Slug</label>
                            <div class="flex rounded-lg">
                                <input id="slug" value="{{ $post->slug }}" name="slug" class="p-2 border-2 block w-full border border-blue-200 focus:border-blue-200 focus:ring-2 outline-none rounded-lg " >
                            </div>
                        </div>
                        <div class="mt-7">
                            <label for="summary-update" class="block text-sm mb-2 font-semibold">Tóm tắt</label>
                            <div class="flex rounded-lg">
                                <input id="summary-update" name="summary-update" value="{{ $post->summary }}" class="p-2 border-2 block w-full border border-blue-200 focus:border-blue-200 focus:ring-2 outline-none rounded-lg" placeholder="Tóm tắt">
                            </div>
                        </div>
                        <div class="mt-7">
                            <label for="image" class="block text-sm mb-2 font-semibold">Hình ảnh</label>
                            <div class="relative">
                                <input type="file" name="image" id="input-image" class="hidden">
                                <div id="image-preview-contain" class="w-96 h-64 flex items-center justify-center cursor-pointer">
                                    <img id="image-preview" class="w-full h-full rounded-xl border-2 " src="{{ Storage::url($post->image->path) }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="mt-7">
                            <label for="content-update" class="block text-sm mb-2 font-semibold">Nội dung</label>
                            <textarea id="content-update" name="content-update">{{$post->content}}</textarea>
                        </div>
                        <div class="mt-7">
                            <label for="status-update" class="block text-sm font-semibold">Trạng thái</label>
                            <div class="flex gap-x-6 rounded-lg h-12">
                                <div class="flex items-center">
                                    <input type="radio" name="status-update" value="0" class="w-5 h-5" id="display" {{ $post->status == 0 ? 'checked' : '' }}>
                                    <label for="display" class="ms-2">Hiển thị</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" name="status-update" value="1" class=" w-5 h-5" id="hidden" {{ $post->status == 1 ? 'checked' : '' }}>
                                    <label for="hidden" class="ms-2">Ẩn</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center mt-7">
                        <button id="editpost" type="submit" class="py-3 px-4 w-36 mb-5 inline-flex justify-center font-bold items-center gap-x-2 rounded-full border border-transparent bg-green-500 text-white hover:bg-green-700 cursor-pointer">
                            Chỉnh sửa Post
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <x-slot name="script">
        <script type="module">
            CKEDITOR.replace('content-update' , {
                height: 500,
                toolbar: [
                    '/',
                    ['Bold', 'Italic', 'Underline', 'StrikeThrough', '-', 'Undo', 'Redo', '-', 'Cut', 'Copy', 'Paste', 'Find', 'Replace', '-', 'Outdent', 'Indent', '-', 'Print'],
                    '/',
                    ['NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
                    ['FontSize', 'Image', 'Table', '-', 'Link', 'Flash', 'Smiley', 'TextColor', 'BGColor', 'Source']
                ],
                fontSize_sizes: '12/12px;14/14px;16/16px;18/18px;24/24px;36/36px;48/48px;'
            });
            $(document).ready(function () {
                window.appConfig = {
                    urls: {
                        post: '{{ route('admin.posts.index') }}',
                    },
                    values: {
                        role: '',
                    },
                    csrfToken: '{{ csrf_token() }}'
                };
            })
        </script>
    </x-slot>
</x-admin-layout>
