<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('สร้าง Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text font-bold mb-2" for="title">
                            {{ __('ชื่อคอร์ส') }}
                        </label>
                        <input id="title" type="text" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text font-bold mb-2" for="description">
                            {{ __('คำอธิบาย') }}
                        </label>
                        <textarea id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text font-bold mb-2" for="thumbnail">
                            {{ __('รูปปกคอร์ส') }}
                        </label>
                        <input id="thumbnail" type="file" name="thumbnail" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700  font-bold mb-2" for="youtube_link">
                            {{ __('ลิงก์ YouTube') }}
                        </label>
                        <input id="youtube_link" type="text" name="youtube_link" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div id="questions-container">
                        <h3 class="text-lg font-semibold mb-4">Questions</h3>
                        <div class="question mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Question:</label>
                            <textarea name="questions[0][question_text]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Option A:</label>
                            <input type="text" name="questions[0][option_a]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Option B:</label>
                            <input type="text" name="questions[0][option_b]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Option C:</label>
                            <input type="text" name="questions[0][option_c]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Option D:</label>
                            <input type="text" name="questions[0][option_d]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Correct Answer:</label>
                            <select name="questions[0][correct_answer]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                                <option value="d">D</option>
                            </select>
                        </div>
                    </div>
                    <button type="button" id="add-question" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Question</button>
                    <div class="flex items-center justify-between mt-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            {{ __('Create Course') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('add-question').addEventListener('click', function() {
            const container = document.getElementById('questions-container');
            const questionCount = container.getElementsByClassName('question').length;
            const newQuestion = document.createElement('div');
            newQuestion.classList.add('question', 'mb-4');
            newQuestion.innerHTML = `
                <label class="block text-gray-700 text-sm font-bold mb-2">Question:</label>
                <textarea name="questions[${questionCount}][question_text]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                <label class="block text-gray-700 text-sm font-bold mb-2">Option A:</label>
                <input type="text" name="questions[${questionCount}][option_a]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <label class="block text-gray-700 text-sm font-bold mb-2">Option B:</label>
                <input type="text" name="questions[${questionCount}][option_b]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <label class="block text-gray-700 text-sm font-bold mb-2">Option C:</label>
                <input type="text" name="questions[${questionCount}][option_c]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <label class="block text-gray-700 text-sm font-bold mb-2">Option D:</label>
                <input type="text" name="questions[${questionCount}][option_d]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <label class="block text-gray-700 text-sm font-bold mb-2">Correct Answer:</label>
                <select name="questions[${questionCount}][correct_answer]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="a">A</option>
                    <option value="b">B</option>
                    <option value="c">C</option>
                    <option value="d">D</option>
                </select>
            `;
            container.appendChild(newQuestion);
        });
    </script>
</x-app-layout>
