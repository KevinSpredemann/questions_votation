<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, put};

it("should update the question in the database", function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create([
        'draft'      => true,
        'created_by' => $user->id,
    ]);

    actingAs($user);
    put(route('question.update', $question), [
        'question' => 'Updated Question?',
    ])
        ->assertRedirect();


    $question->refresh();

    expect($question->question)->toBe('Updated Question?');
});

it("should make sure that only question with status DRAFT can be updated", function () {
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

    put(route('question.update', $questionNotDraft))
        ->assertForbidden();
    put(route('question.update', $questionDraft), [
        'question' => 'New Question',
    ])
        ->assertRedirect();
});

it("should make sure that only the person who has updated the question can update the question", function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();
    $question  = Question::factory()->create([
        'draft'      => true,
        'created_by' => $rightUser->id,
    ]);

    actingAs($wrongUser);
    put(route('question.update', $question))
        ->assertForbidden();

    actingAs($rightUser);
    put(route('question.update', $question), [
        'question' => 'New Question',
    ])
        ->assertRedirect();
});

it("should be able to updated a new question biggest than 255 characters", function () {

    $user     = User::factory()->create();
    $question = Question::factory()->create([
        'draft'      => true,
        'created_by' => $user->id,
    ]);
    actingAs($user);

    $request = put(route("question.update", $question), [
        "question" => str_repeat('*', 260) . '?',
    ]);

    $request->assertRedirect();
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', [
        'question' => str_repeat('*', 260) . '?',
    ]);
});

it("should check if ends with question mark ?", function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create([
        'draft'      => true,
        'created_by' => $user->id,
    ]);
    actingAs($user);

    $request = put(route("question.update", $question), [
        "question" => str_repeat('*', 10),
    ]);
    $request->assertSessionHasErrors(['question' => 'The question must end with a question mark (?).']);
    assertDatabaseHas('questions', [
        'question' => $question->question,
    ]);
});

it("should have at least 10 characters", function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create([
        'draft'      => true,
        'created_by' => $user->id,
    ]);
    actingAs($user);

    $request = put(route("question.update", $question), [
        "question" => str_repeat('*', 8) . '?',
    ]);
    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['attribute' => 'question', 'min' => 10])]);
    assertDatabaseHas('questions', [
        'question' => $question->question,
    ]);
});
