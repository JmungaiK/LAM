<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $primaryKey = 'video_id';

    protected $fillable = [
        'video_title',
        'video_description',
        'video_thumbnail_url',
        'youtube_video_url',
        'video_duration',
    ];

    protected $casts = [
        'video_created_at' => 'datetime',
        'video_updated_at' => 'datetime',
    ];

    /**
     * Define the relationship with the user who created the video.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Define the relationship with categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(VideoCategory::class, 'video_category_mappings', 'video_id', 'category_id');
    }

    /**
     * Define the relationship with comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'video_id', 'video_id');
    }

    /**
     * Define the relationship with ratings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'video_id');
    }
}
