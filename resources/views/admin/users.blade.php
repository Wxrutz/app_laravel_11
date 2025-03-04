<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-600 leading-tight">
            {{ __('รายการผู้ใช้') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-purple-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                        <thead>
                            <tr class="bg-purple-100">
                                <th class="py-3 px-4 border-b text-left text-purple-600">#</th>
                                <th class="py-3 px-4 border-b text-left text-purple-600">ชื่อ</th>
                                <th class="py-3 px-4 border-b text-left text-purple-600">วันที่สร้าง</th>
                                <th class="py-3 px-4 border-b text-left text-purple-600">บทบาท</th>
                                <th class="py-3 px-4 border-b text-center text-purple-600">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr class="border-b hover:bg-purple-50">
                                    <!-- ลำดับที่ -->
                                    <td class="py-3 px-4">{{ $index + 1 }}</td>

                                    <!-- รูปโปรไฟล์ + ชื่อ -->
                                    <td class="py-3 px-4 flex items-center space-x-3">
                                        
                                        <span>{{ $user->name }}</span>
                                    </td>

                                    <!-- วันที่สร้าง -->
                                    <td class="py-3 px-4">{{ $user->created_at->format('d/m/Y') }}</td>

                                    <!-- บทบาท -->
                                    <td class="py-3 px-4">{{ $user->usertype }}</td>

                                    <!-- ปุ่มจัดการ -->
                                    <td class="py-3 px-4 text-center space-x-2">
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="text-yellow-600 hover:text-yellow-800">
                                            ⚙️
                                        </a>

                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('คุณแน่ใจหรือไม่ที่จะลบผู้ใช้นี้?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                ❌
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
