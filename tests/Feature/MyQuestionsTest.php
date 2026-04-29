<?php

use App\Models\{Question, User};
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

use function Pest\Laravel\{actingAs, get};

it("should be able to list all questions created by me", function () {

    $wrongUser      = User::factory()->create();
    $wrongQuestions = Question::factory()->for($wrongUser, 'createdBy')->count(10)->create();

    $user      = User::factory()->create();
    $questions = Question::factory()->for($user, 'createdBy')->count(10)->create();
    actingAs($user);

    $response = get(route('questions.index'));

    /** @var Question $q */
    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }

    /** @var Question $q */
    foreach ($wrongQuestions as $q) {
        $response->assertDontSee($q->question);
    }
});

it("should paginate the result", function () {
    $user = User::factory()->create();
    Question::factory()->for($user, 'createdBy')->count(40)->create();
    actingAs($user);

    get(route('dashboard'))
        ->assertViewHas('questions', function ($value) {
            return $value instanceof LengthAwarePaginator;
        });
});
