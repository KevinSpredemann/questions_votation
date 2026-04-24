<x-app-layout>
    <x-slot name="header">
        <x-header>{{ __('My Questions') }}</x-header>
    </x-slot>
    <x-container>
        <x-form post :action="route('questions.store')">
            <x-textarea label="Question" name="question"></x-textarea>
            <x-btn.primary>Save</x-btn.primary>
            <x-btn.secondary>Cancel</x-btn.secondary>
        </x-form>
        <hr class="border-slate-600 my-4">
        <div class="dark:text-slate-400 mb-4 font-bold uppercase">My Questions</div>
        <div class="dark:text-slate-500 space-y-4">
            @foreach ($questions as $item)
                <x-question :question="$item" />
            @endforeach
        </div>
    </x-container>
</x-app-layout>
