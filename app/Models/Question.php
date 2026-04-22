<?php

namespace App\Models;

use Database\Factories\QuestionFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $question
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */

class Question extends Model
{
    /** @use HasFactory<QuestionFactory> */
    use HasFactory;


    /** @return HasMany<Vote, $this> */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }


    /**
     * Summary of likes
     * @return Attribute<float|int|numeric-string, never>
     */
    public function likes(): Attribute
    {
        return Attribute::get(fn () => $this->votes()->sum('like')) ;
    }

    /**
    * Summary of unlikes
    * @return Attribute<float|int|numeric-string, never>
    */
    public function unlikes(): Attribute
    {
        return Attribute::get(fn () => $this->votes()->sum('unlike')) ;
    }
}
