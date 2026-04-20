<x-app-layout>
    <x-slot name="header"><x-header>{{ __('Dashboard') }}</x-header></x-slot>
    <x-container>
        <x-form post :action="route('questions.store')">
            <x-textarea label="Question" name="question"></x-textarea>
            <x-btn.primary>Save</x-btn.primary>
            <x-btn.secondary>Cancel</x-btn.secondary>
        </x-form>
    </x-container>
</x-app-layout>
