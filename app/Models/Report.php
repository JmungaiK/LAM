<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id',     // User who generated the report
        'report_type', // Type of the report (e.g., daily, weekly, monthly)
        'report_date', // Date for which the report is generated
        'report_data', // Report data (could be in JSON format)
        'status',      // Status of the report (e.g., generated, pending, failed)
        // Add other fillable fields here as needed
    ];

    /**
     * Define the relationship with the user who generated the report.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define the relationship with the videos included in the report.
     */
    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }

    /**
     * Define the relationship with the comments included in the report.
     */
    public function comments()
    {
        return $this->belongsToMany(Comment::class);
    }

    /**
     * Define the relationship with the ratings included in the report.
     */
    public function ratings()
    {
        return $this->belongsToMany(Rating::class);
    }

    /**
     * Define the relationship with the users included in the report (if applicable).
     */
    public function includedUsers()
    {
        return $this->belongsToMany(User::class);
    }

    /*
      Define the relationship with other related entities (adjust the method name and parameters as needed).
     
    public function otherEntities()
    {
        return $this->belongsToMany(::class);
    }

    // Add other relationships and custom methods as needed
     */
}
