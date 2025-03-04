<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-600 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-purple-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($courses as $course)
                            <div onclick="window.location='{{ route('courses.show', $course->id) }}'"
                                class="cursor-pointer border border-yellow-300 p-4 rounded-lg shadow hover:shadow-lg transition bg-white">
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Thumbnail"
                                    class="w-full h-48 object-cover mb-4 rounded">
                                <h3 class="text-lg font-semibold mb-2 text-purple-700">{{ $course->title }}</h3>
                                <p>
                                    @if ($course->userHasAnswered)
                                        <span class="text-green-500">ทำแบบทดสอบแล้ว</span>
                                    @else
                                        <span class="text-red-500">ยังไม่เรียน</span>
                                    @endif
                                </p>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
