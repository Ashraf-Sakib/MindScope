<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mood extends Model
{
    use HasFactory;

    // Allow mass assignment
    protected $fillable = [
        'user_id',
        'mood',
        'note',
    ];

    // If your table is named 'modes', uncomment the line below
    // protected $table = 'modes';

    // Relationship: a Mood belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
