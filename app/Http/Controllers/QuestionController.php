<?php

namespace App\Http\Controllers;

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
}
