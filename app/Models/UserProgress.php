<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_progress_id';

    protected $fillable = [
        'user_id',
        'video_id',
        'video_category_id',
        'user_started_at',
        'user_finished_at',
        'is_video_completed',
    ];

    protected $casts = [
        'user_started_at' => 'datetime',
        'user_finished_at' => 'datetime',
        'is_video_completed' => 'boolean',
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }

    public function videoCategory()
    {
        return $this->belongsTo(VideoCategory::class, 'video_category_id');
    }
}
