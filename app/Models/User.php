<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_name',
        'user_email',
        'user_password',
        'user_role',
    ];

    protected $hidden = [
        'user_password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Determine if the user is an administrator.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->user_role === 'admin';
    }

    /**
     * Determine if the user is a moderator.
     *
     * @return bool
     */
    public function isModerator()
    {
        return $this->user_role === 'moderator';
    }

    /**
     * Define the relationship with videos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos()
    {
        return $this->hasMany(Video::class, 'user_id', 'user_id');
    }

    /**
     * Define the relationship with comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'user_id');
    }

    /**
     * Define the relationship with ratings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'user_id');
    }


    /**
     * Define the relationship with user progress.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userProgress()
    {
        return $this->hasMany(UserProgress::class, 'user_id', 'user_id');
    }

    /**
     * Define the relationship with moderators.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function moderator()
    {
        return $this->hasOne(Moderator::class, 'user_id', 'user_id');
    }

    /**
     * Define the relationship with administrators.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function administrator()
    {
        return $this->hasOne(Administrator::class, 'user_id', 'user_id');
    }
}
