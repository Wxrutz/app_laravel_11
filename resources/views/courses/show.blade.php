<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-purple-600 leading-tight text-center">
            {{ $course->title }}
        </h2>
    </x-slot>

    <div class="py-12 bg-purple-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    @php
                        $youtube_link = $course->youtube_link;
                        if (strpos($youtube_link, 'youtu.be') !== false) {
                            $video_id = substr(parse_url($youtube_link, PHP_URL_PATH), 1);
                        } elseif (strpos($youtube_link, 'youtube.com') !== false) {
                            parse_str(parse_url($youtube_link, PHP_URL_QUERY), $query_params);
                            $video_id = $query_params['v'] ?? null;
                        } else {
                            $video_id = null;
                        }
                    @endphp

                    @if ($video_id)
                        <div class="relative">
                            <iframe class="w-full h-96 rounded-lg shadow-lg" src="https://www.youtube.com/embed/{{ $video_id }}" frameborder="0" allowfullscreen></iframe>
                            <div class="absolute top-2 left-2 bg-white p-2 rounded-lg shadow text-sm font-semibold">{{ $course->title }}</div>
                        </div>
                    @else
                        <p class="text-red-500 mt-4">เกิดข้อผิดพลาด โปรดลองอีกครั้งในภายหลัง (ID การเล่น: {{ $course->youtube_link }})</p>
                    @endif

                    <p class="mt-6 text-lg font-semibold">{{ $course->description }}</p>
                </div>
            </div>

            <div class="mt-6 bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-xl font-semibold text-purple-600 text-center">คะแนนล่าสุด</h3>
                <div class="text-center mt-4">
                    @if (session('results'))
                        @php
                            $sessionTotalQuestions = count(session('results'));
                            $sessionCorrectAnswers = count(array_filter(session('results')));
                        @endphp
                        <p class="text-lg">คุณได้ {{ $sessionCorrectAnswers }} จาก {{ $sessionTotalQuestions }} คำถาม</p>
                    @else
                        @php
                            $totalQuestions = $course->questions->count();
                            $correctAnswers = \App\Models\Answers::where('user_id', Auth::id())
                                ->whereIn('question_id', $course->questions->pluck('id'))
                                ->where('is_correct', true)
                                ->count();
                        @endphp
                        @if ($totalQuestions > 0)
                            <p class="text-lg">คุณได้ {{ $correctAnswers }} จาก {{ $totalQuestions }} คำถาม</p>
                        @else
                            <p class="text-lg text-gray-500">ยังไม่มีแบบทดสอบในคอร์สนี้</p>
                        @endif
                    @endif
                </div>
                <div class="text-center mt-6">
                    @if ($course->userHasAnswered)
                        <a href="{{ url('courses/' . $course->id . '/questions') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">ทำแบบทดสอบใหม่</a>
                    @else
                        <a href="{{ url('courses/' . $course->id . '/questions') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">ทำแบบทดสอบ</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
