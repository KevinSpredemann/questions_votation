@props(['label', 'name' => null, 'value' => null])

<div class="mb-4">
    <label for="{{ $name }}" class="block mb-2.5 text-sm font-medium text-black dark:text-white">
        {{ $label }}
    </label>
    <textarea name="{{ $name }}" id="{{ $name }}" rows="4"
        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Ask me a question...">{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
