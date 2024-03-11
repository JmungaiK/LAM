<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;

    protected $primaryKey = 'administrator_id';

    protected $fillable = [
        'user_id',
    ];

    protected $casts = [
        'administrator_created_at' => 'datetime',
        'administrator_updated_at' => 'datetime',
    ];

    /**
     * Get the user associated with the administrator.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
