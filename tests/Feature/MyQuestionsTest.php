<?php

use App\Models\{Question, User};
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

use function Pest\Laravel\{actingAs, get, withoutExceptionHandling};

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

it("should order my like and unlike, most like question should be at the top, most unlike question should be at the bottom", function () {
    $user       = User::factory()->create();
    $secondUser = User::factory()->create();
    Question::factory()->count(5)->create();
    $mostLikedQuestion   = Question::find(3);
    $mostUnlikedQuestion = Question::find(1);
    $user->like($mostLikedQuestion);
    $secondUser->unlike($mostUnlikedQuestion);

    withoutExceptionHandling();
    actingAs($user);

    get(route('dashboard'))
        ->assertViewHas('questions', function ($questions) {
            expect($questions->first()->id)->toBe(3)
                ->and($questions->last()->id)->toBe(1);

            return true;
        });
});
