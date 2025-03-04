<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-600 leading-tight">
            {{ __('Admin Courses') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-purple-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">สร้างคอร์สใหม่</a>
                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="px-4 py-2">Title</th>
                                <th class="px-4 py-2">Description</th>
                                <th class="px-4 py-2">Thumbnail</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr class="bg-white text-gray-900">
                                    <td class="border px-4 py-2">{{ $course->title }}</td>
                                    <td class="border px-4 py-2">{{ Str::limit($course->description, 50) }}</td>
                                    <td class="border px-4 py-2">
                                        <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Thumbnail" class="w-32">
                                    </td>                                    
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-sm btn-primary">แก้ไขคอร์ส</a>
                                        <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">ลบ</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
