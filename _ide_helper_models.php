<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */

namespace App\Models{
    /**
     * @property int $id
     * @property string $question
     * @property \Illuminate\Support\Carbon $created_at
     * @property \Illuminate\Support\Carbon $updated_at
     * @method static \Database\Factories\QuestionFactory factory($count = null, $state = [])
     * @method static \Illuminate\Database\Eloquent\Builder<static>|Question newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder<static>|Question newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder<static>|Question query()
     * @method static \Illuminate\Database\Eloquent\Builder<static>|Question whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder<static>|Question whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder<static>|Question whereQuestion($value)
     * @method static \Illuminate\Database\Eloquent\Builder<static>|Question whereUpdatedAt($value)
     */
    class Question extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * @property int $id
     * @property string $name
     * @property string $email
     * @property \Illuminate\Support\Carbon|null $email_verified_at
     * @property string $password
     * @property string|null $remember_token
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
     * @property-read int|null $notifications_count
     * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Vote> $votes
     * @property-read int|null $votes_count
     * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
     * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
     * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
     * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
     * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
     * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
     */
    class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail
    {
    }
}

namespace App\Models{
    /**
     * @property int $id
     * @property int|null $question_id
     * @property int|null $user_id
     * @property int $like
     * @property int $unlike
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @method static \Illuminate\Database\Eloquent\Builder<static>|Vote newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder<static>|Vote newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder<static>|Vote query()
     * @method static \Illuminate\Database\Eloquent\Builder<static>|Vote whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder<static>|Vote whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder<static>|Vote whereLike($value)
     * @method static \Illuminate\Database\Eloquent\Builder<static>|Vote whereQuestionId($value)
     * @method static \Illuminate\Database\Eloquent\Builder<static>|Vote whereUnlike($value)
     * @method static \Illuminate\Database\Eloquent\Builder<static>|Vote whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder<static>|Vote whereUserId($value)
     */
    class Vote extends \Eloquent
    {
    }
}
