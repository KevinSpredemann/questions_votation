@props(['question'])

<div
    class="rounded dark:bg-slate-800/50 dark:text-slate-400 shadow shadow-blue-500/50 p-3 flex justify-between items-center">
    <span>{{ $question->question }}</span>
    <div>
        <x-form :action="route('question.like', $question)">
            <button class="flex items-start space-x-1"><x-icons.thumbs-up
                    class="w-5 h-5 text-green-500 hover:text-green-300 cursor-pointer" />
                <span class="text-green-500">
                    {{ $question->votes_sum_like ?? 0 }}
                </span>
            </button>
        </x-form>
        <x-form :action="route('question.unlike', $question)">
            <button class="flex items-start space-x-1"><x-icons.thumbs-down
                    class="w-5 h-5 text-red-500 hover:text-red-300 cursor-pointer" />
                <span class="text-red-500">
                    {{ $question->votes_sum_unlike ?? 0 }}
                </span>
            </button>
        </x-form>
    </div>
</div>
