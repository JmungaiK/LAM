<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->bigIncrements('video_id'); // Change to bigIncrements for compatibility with other tables
            $table->string('video_title');
            $table->text('video_description')->nullable();
            $table->string('video_thumbnail_url')->nullable();
            $table->string('youtube_video_url');
            $table->integer('video_duration')->nullable();
            $table->timestamp('video_created_at')->useCurrent();
            $table->timestamp('video_updated_at')->nullable()->default(null); // Set default value to NULL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
