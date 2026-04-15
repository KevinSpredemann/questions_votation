<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it("should be able to create a new question biggest than 255 characters", function () {

    $user = User::factory()->create();
    actingAs($user);

    $request = post(route("questions.store"), [
        "question" => str_repeat('*', 260) . '?',
    ]);

    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', [
        'question' => str_repeat('*', 260) . '?',
    ]);
});

it("should check if ends with question mark ?", function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route("questions.store"), [
        "question" => str_repeat('*', 10),
    ]);
    $request->assertSessionHasErrors(['question' => 'The question must end with a question mark.']);
    assertDatabaseCount('questions', 0);

});

it("should have at least 10 characters", function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route("questions.store"), [
        "question" => str_repeat('*', 8) . '?',
    ]);
    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['attribute' => 'question', 'min' => 10])]);
    assertDatabaseCount('questions', 0);


});
