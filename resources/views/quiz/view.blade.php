@extends('layouts.app', ['navTitle' => 'View Quiz'])

@section('content')
    <div class="flex flex-col gap-6 max-w-3xl mx-auto p-6">
        @csrf
        <h1 class="self-center w-full text-2xl font-bold text-center text-gray-900 dark:text-gray-100 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg  border-gray-300 dark:border-gray-600">
            Viewing Quiz: {{ $quiz->title }}
        </h1>

        @foreach ($quiz->questions as $question)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 ">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $loop->iteration }}. {{ $question->question_text }}</h3>
                <ul class="mt-2 space-y-2">
                    @foreach ($question->options as $option) <!-- Decode JSON options -->
                        <li>
                            <label class="flex items-center p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-150">
                                <input disabled type="radio" name="question_{{ $question->id }}" value="{{ $option->option_text }}" class="mr-2" required
									{{ $option->is_correct ? 'checked' : '' }}>
                                <span class="text-gray-700 dark:text-gray-300">{{ $option->option_text }}</span>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
	</div>
@endsection