<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Symfony\Component\HttpFoundation\RedirectResponse;

class QuestionController extends Controller
{
    public function store(): RedirectResponse
    {

        Question::query()
            ->create(
                request()
            ->validate([
                'question' => ['required'],
            ])
            );

        return to_route("dashboard");
    }
}
