<x-admin-layout>
    <x-slot name="title">
        Đăng nhập trang quản trị
    </x-slot>
    <div class="flex justify-center mt-16 h-full">
        <div class="sm:max-w-lg sm:w-full sm:mx-auto">
            <div class="bg-white border border-gray-200 rounded-2xl shadow-lg">
                <div class="p-6 sm:p-8">
                    <!-- Header -->
                    <div class="text-center">
                        <h2 class="text-3xl font-bold text-gray-900">Quản trị viên Thoitietnow</h2>
                        <p class="mt-2 text-sm text-gray-600">Đăng nhập vào tài khoản quản trị của bạn</p>
                    </div>

                    <!-- Form -->
                    <div class="mt-8">
                        <form method="post" action="{{ route('admin.signin.store') }}">
                            @csrf
                            <div class="space-y-6">
                                <!-- Username Input -->
                                <div>
                                    <label for="username" class="block text-sm font-medium text-gray-700">Tên đăng nhập</label>
                                    <div class="mt-1 relative">
                                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                                               class="py-3 px-4 block w-full border border-gray-300 rounded-lg text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                               placeholder="Nhập tên đăng nhập" required autofocus>
                                        @error('username')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Password Input -->
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700">Mật khẩu</label>
                                    <div class="mt-1 relative">
                                        <input type="password" id="password" name="password"
                                               class="py-3 px-4 block w-full border border-gray-300 rounded-lg text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                               placeholder="Nhập mật khẩu" required>
                                        @error('password')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div>
                                    <button type="submit" class="w-full py-3 px-4 flex justify-center items-center text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Đăng nhập</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
