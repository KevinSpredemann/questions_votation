<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it("should be able to open a question edit", function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create([
        'draft'      => true,
        'created_by' => $user->id,
    ]);
    ;

    actingAs($user);

    get(route('question.edit', $question))
        ->assertSuccessful();
});

it("should return a view", function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create([
        'draft'      => true,
        'created_by' => $user->id,
    ]);

    actingAs($user);

    get(route('question.edit', $question))
        ->assertViewIs('question.edit');
});

it("should make sure that only question with status DRAFT can be", function () {
    $user             = User::factory()->create();
    $questionNotDraft = Question::factory()->create([
        'draft'      => false,
        'created_by' => $user->id,
    ]);
    $questionDraft = Question::factory()->create([
        'draft'      => true,
        'created_by' => $user->id,
    ]);

    actingAs($user);

    get(route('question.edit', $questionNotDraft))
        ->assertForbidden();
    get(route('question.edit', $questionDraft))
        ->assertSuccessful();
});
