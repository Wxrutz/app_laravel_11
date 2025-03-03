<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>{{ $course->description }}</p>
                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Thumbnail" class="w-64 mt-4">
                    <div class="mt-4">
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
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $video_id }}" frameborder="0" allowfullscreen></iframe>
                        @else
                            <p>เกิดข้อผิดพลาด โปรดลองอีกครั้งในภายหลัง (ID การเล่น: {{ $course->youtube_link }})</p>
                        @endif
                    </div>
                    <div class="mt-4">
                        @if (session('results'))
                            <div class="mb-4">
                                <h3>คะแนนล่าสุด:</h3>
                                @php
                                    $sessionTotalQuestions = count(session('results'));
                                    $sessionCorrectAnswers = count(array_filter(session('results')));
                                @endphp
                                <p>คุณได้ {{ $sessionCorrectAnswers }} จาก {{ $sessionTotalQuestions }} คำถาม</p>
                            </div>
                        @else
                            @php
                                $totalQuestions = $course->questions->count();
                                $correctAnswers = \App\Models\Answers::where('user_id', Auth::id())
                                    ->whereIn('question_id', $course->questions->pluck('id'))
                                    ->where('is_correct', true)
                                    ->count();
                            @endphp
                            @if ($totalQuestions > 0)
                                <div class="mb-4">
                                    <h3>คะแนนล่าสุด:</h3>
                                    <p>คุณได้ {{ $correctAnswers }} จาก {{ $totalQuestions }} คำถาม</p>
                                </div>
                            @endif
                        @endif

                        @if ($course->userHasAnswered)
                            <a href="{{ url('courses/' . $course->id . '/questions') }}" class="btn btn-primary">ทำแบบทดสอบใหม่</a>
                        @else
                            <a href="{{ url('courses/' . $course->id . '/questions') }}" class="btn btn-primary">ทำแบบทดสอบ</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
