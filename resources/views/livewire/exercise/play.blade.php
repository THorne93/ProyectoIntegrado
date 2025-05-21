<div class="h-screen w-full p-6 pb-28 overflow-y-scroll scrollBarThin">
    <div class="w-full mx-auto space-y-6 p-2 px-4 bg-white border border-black rounded-lg">

        <div x-data="{
            seconds: 0,
            minutes: 0,
            interval: null,
            confirm: @entangle('confirmPlay')
        }" x-init="interval = setInterval(() => {
            if (!confirm) {
                seconds++;
                if (seconds === 60) {
                    seconds = 0;
                    minutes++;
                }
            } else {
                clearInterval(interval);
            }
        }, 1000)"
            class="text-xl font-semibold dark:text-white bg-white px-4 py-2 z-50">
            <span x-text="String(minutes).padStart(2, '0')"></span> :
            <span x-text="String(seconds).padStart(2, '0')"></span>
        </div>
        <div class="my-2 pb-2">
            @switch($exercise->part)
                @case(1)
                    <p>For questions <strong>1-8</strong>, read the text below and decide which answer
                        (<strong>A,B,C</strong> or <strong>D</strong>) best fits each gap. There is an example at the
                        beginning (<strong>0</strong>).</p>
                @break

                @case(2)
                    <p>For questions <strong>1-8</strong>, read the text below and think of the word that best fits each
                        gap. Use only one word in each gap. There is an example at the beginning (<strong>0</strong>).</p>
                @break

                @case(3)
                    <p>For questions <strong>1-8</strong>, read the text below. Use the word given in capitals to form a
                        word that fits in the gap. There is an example at the beginning (<strong>0</strong>).</p>
                @break

                @case(4)
                    <p>For questions <strong>1-8</strong>, complete the second sentence so that it has a similar meaning to
                        the first sentence, using the word given. <strong>Do not change the word given.</strong> You must
                        use between two and five words, including the word given. Here is an example.</p>
                    <p>0. A very friendly taxi driver drove us into town.</p>
                    <p><strong>DRIVEN</strong></p>
                    <p>We <strong>were driven into town by</strong> a very friendly taxi driver.</p>
                @break

                @default
            @endswitch
        </div>

        <form x-ref="submitForm" class="p-4" method="post" wire:submit.prevent="submitAnswers">
            @csrf

            <div class="w-full flex flex-row gap-4">
                <div class="{{ $exercise->part == '4' ? 'w-full' : 'w-1/2 border-r border-r-gray-400' }}  pe-2 ">
                    <h3 class="my-2 text-center text-3xl font-bold dark:text-white">{{ $exercise->title }}</h3>
                    @unless ($exercise->part == '4')
                        @foreach ($questions as $question)
                            <div class="max-w-full overflow-hidden">
                                {!! $question->prompt !!}
                            </div>
                        @endforeach
                    @else
                        @foreach ($questions as $index => $question)
                            <div class="max-w-full overflow-hidden py-3 border-b border-b-gray-200">
                                <p><span class="text-lg w-4 font-semibold mr-2">{{ $index + 1 }}.</span>
                                    {!! $question->prompt !!}</p>
                                <p class="my-1"><strong>{{ $question->answers[0]->hint }}</strong></p>
                                <p>
                                    {{ $question->before_prompt }}
                                    <input type="text" autocomplete="off" id="answer-{{ $index }}"
                                    {{ $finished ? 'disabled' : '' }}
                                        data-index="{{ $index }}" oninput="validateWordCount(this, 2, 5)"
                                        wire:model.defer="userAnswers.{{ $index }}"
                                        class="w-2/5 p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                    {{ $question->after_prompt }}

                                    <span id="word-count-{{ $index }}"
                                        class="block text-xs mt-1 text-gray-500"></span>
                                    <span id="word-warning-{{ $index }}"
                                        class="block text-xs mt-1 text-red-500 font-semibold"></span>
                                    @if ($finished)
                                        @if (isset($results[$index]))
                                            @if ($results[$index] == 2)
                                                <span class="text-green-600 font-bold ml-2">✔
                                                    {{ $results[$index] }}/2</span>
                                            @elseif($results[$index] == 1)
                                                <span class="text-yellow-300 font-bold ml-2">✘
                                                    {{ $results[$index] }}/2</span>
                                                <p class="font-bold">Answer: {{ $question->answers[0]->value }}</p>
                                            @else
                                                <span class="text-red-600 font-bold ml-2">✘ {{ $results[$index] }}/2</span>
                                                <p class="font-bold">
    Answer: {{
        implode(' OR ', array_map(fn($ans) => "\"$ans\"", json_decode($question->answers[0]->value, true) ?? []))
    }}
</p>
                                            @endif
                                        @endif
                                    @endif
                                </p>
                            </div>
                        @endforeach

                        <div class="w-full flex justify-center mt-4">
                            @if ($finished === false)
                                @if ($exercise->part == '4')
                                    <button type="button" wire:click="triggerConfirm"
                                        class=" text-gray-900 font-extrabold bg-white border border-black focus:outline-none hover:bg-[#FCFDAF] focus:ring-4 focus:ring-gray-100 rounded-lg text-m px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                        Finish
                                    </button>
                                @endif
                            @else
                                <div class="flex flex-col items-center space-y-2 text-center">
                                    <p class="text-lg font-bold">You scored {{ $finalScore }} /
                                        @if ($exercise->part == 4)
                                            12
                                        @else
                                            8
                                        @endif
                                    </p>
                                    <p>
                                        @if ($finalScore < ($exercise->part == 4 ? 6 : 4))
                                            Not great, but with enough practice you'll do just fine!
                                        @elseif($finalScore <= ($exercise->part == 4 ? 11 : 7))
                                            Nearly there! A little more practice and you'll be perfect!
                                        @else
                                            Wow! Amazing! Perfect score!
                                        @endif
                                    </p>
                                    <a class="text-gray-900 my-2 font-extrabold bg-white border border-black focus:outline-none hover:bg-[#FCFDAF] focus:ring-4 focus:ring-gray-100 rounded-lg text-m px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                        href="{{ route('exercises.part', ['part' => $exercise->part]) }}">Go back
                                        to
                                        Exercises</a>
                                </div>
                            @endif
                        </div>
                    @endunless

                </div>
                <div x-data class="{{ $exercise->part == '4' ? 'w-0' : 'w-1/2' }}">
                    <div class="flex justify-center mt-6 flex-col items-center w-full h-84">
                        <div class="w-full overflow-y-auto scrollBarThin">
                            @if ($exercise->part == 1)
                                @foreach ($questions[0]->choices as $index => $choice)
                                    <div class="flex  items-center mb-2 w-full">
                                        <span class="text-lg w-4 font-semibold mr-2">{{ $index }}.</span>

                                        <ul
                                            class="flex items-center justify-between  mx-2 w-full text-sm font-medium text-gray-900 bg-white rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            @php
                                                $choiceOptions = explode('/', $choice->values);
                                                $optionLabels = ['A', 'B', 'C', 'D'];
                                            @endphp
                                            @foreach ($choiceOptions as $key => $value)
                                                <li
                                                    class="flex-1 flex items-center justify-center border-b border-gray-200 sm:border-b-0 dark:border-gray-600">
                                                    <input
                                                        id="question-{{ $index }}-option-{{ $key }}"
                                                        @if ($finished) disabled @endif
                                                        type="radio" name="question-{{ $index }}"
                                                        value="{{ $value }}"
                                                        @if ($index == 0) disabled
                                                        @if (trim($value) === trim($choice->is_correct)) checked @endif
                                                    @else wire:model.defer="userAnswers.{{ $index }}"
                                                        @endif
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                                    >
                                                    <label
                                                        for="question-{{ $index }}-option-{{ $key }}"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                        <strong>{{ $optionLabels[$key] }}.
                                                        </strong>{{ $value }}
                                                        @if ($finished && $index != 0)
                                                            @php
                                                                $userAnswer = $userAnswers[$index] ?? null;
                                                                $correctAnswer = trim($choice->is_correct);
                                                                $currentOption = trim($value);
                                                            @endphp

                                                            {{-- Show ✔ if this is the correct answer --}}
                                                            @if ($currentOption === $correctAnswer)
                                                                <span class="text-green-600 font-bold ml-2">✔</span>
                                                                {{-- Show ✘ if this was the selected (but wrong) answer --}}
                                                            @elseif ($userAnswer === $currentOption)
                                                                <span class="text-red-600 font-bold ml-2">✘</span>
                                                            @endif
                                                        @endif
                                                    </label>
                                                </li>
                                            @endforeach

                                        </ul>

                                    </div>
                                @endforeach
                            @elseif($exercise->part == 2)
                                @foreach ($questions[0]->answers as $index => $question)
                                    <div class="flex items-center mb-2 w-full">
                                        <span class="text-lg w-4 font-semibold mr-2">{{ $index }}.</span>

                                        <input type="text" autocomplete="off" id="{{ $index }}"
                                            placeholder="{{ $index == 0 ? $question->value : '' }}"
                                            {{ $finished ? 'disabled' : '' }}
                                            wire:model.defer="userAnswers.{{ $index }}"
                                            {{ $index == 0 ? 'disabled' : '' }}
                                            class="w-1/2  mx-2 p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        @if ($finished && !$index == 0)
                                            @if (isset($results[$index]))
                                                @if ($results[$index] == 1)
                                                    <span class="text-green-600 font-bold ml-2">✔</span>
                                                @else
                                                    <span class="text-red-600 font-bold mx-2">✘</span>
                                                    <p class="font-bold"> {{ $question->value }}</p>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            @elseif($exercise->part == 3)
                                @foreach ($questions[0]->answers as $index => $question)
                                    <div class="flex items-center mb-2 w-full">
                                        <span class="text-lg w-4 font-semibold mr-2">{{ $index }}.</span>

                                        <input type="text" autocomplete="off" id="{{ $index }}"
                                        {{ $finished ? 'disabled' : '' }}
                                            placeholder="{{ $index == 0 ? $question->value : '' }}"
                                            wire:model.defer="userAnswers.{{ $index }}"
                                            {{ $index == 0 ? 'disabled' : '' }}
                                            class="w-2/5 p-2 mx-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <span class="text-lg font-semibold  ml-2 ">{{ $question->hint }}</span>
                                        @if ($finished && !$index == 0)
                                            @if (isset($results[$index]))
                                                @if ($results[$index] == 1)
                                                    <span class="text-green-600 font-bold ml-2">✔</span>
                                                @else
                                                    <span class="text-red-600 font-bold mx-2">✘</span>
                                                    <p class="font-bold">{{ $question->value }}</p>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                            <div class="w-full flex justify-center mt-4">
                                @if ($finished === false)
                                    @if ($exercise->part !== '4')

                                        <button type="button" wire:click="triggerConfirm"
                                            class=" text-gray-900 font-extrabold bg-white border border-black focus:outline-none hover:bg-[#FCFDAF] focus:ring-4 focus:ring-gray-100 rounded-lg text-m px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                            Finish
                                        </button>


                                    @endif
                                @else
                                    <div class="flex flex-col items-center space-y-2 text-center">
                                        <p class="text-lg font-bold">You scored {{ $finalScore }} /
                                            @if ($exercise->part == 4)
                                                12
                                            @else
                                                8
                                            @endif
                                        </p>
                                        <p>
                                            @if ($finalScore < ($exercise->part == 4 ? 6 : 4))
                                                Not great, but with enough practice you'll do just fine!
                                            @elseif($finalScore <= ($exercise->part == 4 ? 11 : 7))
                                                Nearly there! A little more practice and you'll be perfect!
                                            @else
                                                Wow! Amazing! Perfect score!
                                            @endif
                                        </p>
                                        <a class="text-gray-900 my-2 font-extrabold bg-white border border-black focus:outline-none hover:bg-[#FCFDAF] focus:ring-4 focus:ring-gray-100 rounded-lg text-m px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                            href="{{ route('exercises.part', ['part' => $exercise->part]) }}">Go back
                                            to
                                            Exercises</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div x-cloak x-data="{ confirm: @entangle('confirmPlay').live }" x-show="confirm"
                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" x-transition>
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg max-w-md w-full space-y-4">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Confirm Submission</h2>
                            <p class="text-gray-700 dark:text-gray-300">Are you sure you want to submit your answers?
                            </p>
                            <div class="flex justify-end gap-4">
                                <button wire:click='triggerConfirm'
                                    class="px-4 py-2 bg-white hover:bg-[#FCFDAF] border border-black rounded-md text-sm dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-white hover:bg-green-400 border border-black text-black rounded-md text-sm">
                                    Yes, Submit
                                </button>
                            </div>

                        </div>

                    </div>
        </form>
    </div>
</div>
@push('scripts')
    <script>
        function validateWordCount(input, min, max) {
            const index = input.dataset.index;
            const words = input.value.trim().split(/\s+/).filter(w => w.length);
            const countDisplay = document.getElementById(`word-count-${index}`);
            const warningDisplay = document.getElementById(`word-warning-${index}`);

            countDisplay.textContent = `${words.length} / ${max} words`;

            if (words.length < min) {
                warningDisplay.textContent = `You need to use at least ${min} words.`;
            } else if (words.length > max) {
                warningDisplay.textContent = `You can only use a maximum of ${max} words.`;
            } else {
                warningDisplay.textContent = '';
            }
        }
    </script>
@endpush

</div>

<input type="hidden" name="exercise_id" value="{{ $exercise->id }}">
<input type="hidden" name="part" value="{{ $exercise->part }}">
<input type="hidden" name="time" x-ref="time" :value="`${minutes}:${seconds}`">


</div>
