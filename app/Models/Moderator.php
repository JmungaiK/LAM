<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moderator extends Model
{
    use HasFactory;

    protected $primaryKey = 'moderator_id';

    protected $fillable = [
        'user_id',
    ];

    protected $casts = [
        'moderator_created_at' => 'datetime',
        'moderator_updated_at' => 'datetime',
    ];

    /**
     * Get the user associated with the moderator.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
