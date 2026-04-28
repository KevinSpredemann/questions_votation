<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class QuestionController extends Controller
{
    public function index(): View
    {
        return view("question.index", [
            'questions' => Auth::user()->questions,
        ]);
    }

    public function destroy(Question $question): RedirectResponse
    {
        $this->authorize('destroy', $question);

        $question->delete();

        return back();
    }
    public function store(): RedirectResponse
    {
        request()
            ->validate([
                'question' => [
                    'required',
                    'min:10',
                    function (string $attribute, mixed $value, Closure $fail) {
                        if (!str_ends_with($value, '?')) {
                            $fail('The question must end with a question mark (?).');
                        }
                    }
                ],
            ]);

        Auth::user()->questions()->create([
            'question' => request('question'),
            'draft'    => true,
        ]);

        return back();
    }

    public function edit(Question $question): View
    {
        $this->authorize('update', $question);

        return view('question.edit', compact('question'));
    }

    public function update(Question $question): RedirectResponse
    {

        request()
            ->validate([
                'question' => [
                    'required',
                    'min:10',
                    function (string $attribute, mixed $value, Closure $fail) {
                        if (!str_ends_with($value, '?')) {
                            $fail('The question must end with a question mark (?).');
                        }
                    }
                ],
            ]);

        $this->authorize('update', $question);
        $question->question = request('question');
        $question->save();

        return to_route('questions.index');
    }
}
