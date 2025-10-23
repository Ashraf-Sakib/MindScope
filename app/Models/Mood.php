<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Mood
 *
 * @property int $id
 * @property int $user_id
 * @property string $mood
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Mood newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mood newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mood query()
 * @method static \Illuminate\Database\Eloquent\Builder|Mood whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mood whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mood whereMood($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mood whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mood whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mood whereUserId($value)
 * @mixin \Eloquent
 */
class Mood extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'mood',
        'note',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
