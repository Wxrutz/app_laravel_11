<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->title }} - Questions
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="w-full max-w-2xl bg-white p-6 rounded-lg shadow-md" x-data="quiz">

            <form action="{{ route('courses.submit', $course->id) }}" method="POST">
                @csrf
                @foreach ($course->questions as $question)
                    <div class="mb-6">
                        <p class="font-semibold text-lg">{{ $question->question_text }}</p>
                        <div class="space-y-2">
                            @foreach (['a', 'b', 'c', 'd'] as $option)
                                <label class="block cursor-pointer">
                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option }}" 
                                           class="hidden"
                                           x-model="selectedAnswers[{{ $question->id }}]"
                                           x-on:change="checkAnswer({{ $question->id }}, '{{ $option }}', '{{ $question->correct_option }}')">
                                    <div class="p-3 border rounded-lg transition-all"
                                         x-bind:class="{
                                             'bg-green-200 border-green-600': selectedAnswers[{{ $question->id }}] === '{{ $option }}' && '{{ $option }}' === '{{ $question->correct_option }}',
                                             'bg-red-200 border-red-600': selectedAnswers[{{ $question->id }}] === '{{ $option }}' && '{{ $option }}' !== '{{ $question->correct_option }}',
                                             'hover:bg-gray-100': selectedAnswers[{{ $question->id }}] !== '{{ $option }}'
                                         }">
                                        {{ $question["option_".$option] }}
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                        Next >
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('quiz', () => ({
                selectedAnswers: {},
                checkAnswer(questionId, selectedOption, correctOption) {
                    this.selectedAnswers[questionId] = selectedOption;
                }
            }));
        });
    </script>
</x-app-layout>
