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
        <div class="dark:text-slate-400 mb-4 font-bold uppercase">Drafts</div>
        <div class="dark:text-slate-500 space-y-4">
            <x-table>
                <x-table.thead>
                    <tr>
                        <x-table.th-col>Question</x-table.th-col>
                        <x-table.th-col>Actions</x-table.th-col>
                    </tr>
                </x-table.thead>
                <tbody>
                    @foreach ($questions->where('draft', true) as $question)
                        <x-table.tr>
                            <x-table.td>{{ $question->question }}</x-table.td>
                            <x-table.td>
                                <x-form :action="route('questions.destroy', $question)" delete>
                                    <button type="submit" class="hover:underline text-red-500">Deletar</button>
                                </x-form>
                                <x-form :action="route('questions.publish', $question)" put>
                                    <button type="submit" class="hover:underline text-green-500">Publicar</button>
                                </x-form>
                                <a href="{{ route('question.edit', $question) }}" class="hover:underline text-blue-500">
                                    Editar
                                </a>
                            </x-table.td>
                        </x-table.tr>
                    @endforeach
                </tbody>
            </x-table>
        </div>
        <div class="dark:text-slate-400 mb-4 mt-10 font-bold uppercase">My Questions</div>
        <div class="dark:text-slate-500 space-y-4">
            <x-table>
                <x-table.thead>
                    <tr>
                        <x-table.th-col>Question</x-table.th-col>
                        <x-table.th-col>Actions</x-table.th-col>
                    </tr>
                </x-table.thead>
                <tbody>
                    @foreach ($questions->where('draft', false) as $question)
                        <x-table.tr>
                            <x-table.td>{{ $question->question }}</x-table.td>
                            <x-table.td>
                                <x-form :action="route('questions.destroy', $question)" delete>
                                    <button type="submit" class="hover:underline text-red-500">Deletar</button>
                                </x-form>
                            </x-table.td>
                        </x-table.tr>
                    @endforeach
                </tbody>
            </x-table>
        </div>
    </x-container>
</x-app-layout>
