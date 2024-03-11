<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'video_category_id';

    protected $fillable = [
        'video_category_name',
        'video_category_description',
    ];

    protected $casts = [
        'video_category_created_at' => 'datetime',
        'video_category_updated_at' => 'datetime',
    ];

    /**
     * Define the relationship with the videos table.
     */
    public function videos()
    {
        return $this->belongsToMany(Video::class, 'video_category_mappings', 'category_id', 'video_id');
    }
}
