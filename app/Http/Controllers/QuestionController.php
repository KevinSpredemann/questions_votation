<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Closure;
use Symfony\Component\HttpFoundation\RedirectResponse;

class QuestionController extends Controller
{
    public function store(): RedirectResponse
    {

        Question::query()
            ->create(
                request()
            ->validate([
                'question' => ['required', 'min:10',
                    function (string $attribute, mixed $value, Closure $fail) {
                        if (!str_ends_with($value, '?')) {
                            $fail('The question must end with a question mark.');
                        }
                    }
                ],
            ])
            );

        return to_route("dashboard");
    }
}
