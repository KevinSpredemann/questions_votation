<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class QuestionController extends Controller
{
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

        return to_route("dashboard");
    }
}
