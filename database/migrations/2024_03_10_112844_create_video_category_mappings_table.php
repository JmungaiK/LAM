<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoCategoryMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_category_mappings', function (Blueprint $table) {
            $table->bigIncrements('video_category_mapping_id');
            $table->unsignedBigInteger('video_id');
            $table->unsignedBigInteger('video_category_id'); // Updated column name
            $table->foreign('video_id')->references('video_id')->on('videos')->onDelete('cascade');
            $table->foreign('video_category_id')->references('video_category_id')->on('video_categories')->onDelete('cascade'); // Updated reference column name
            $table->timestamp('video_category_created_at')->useCurrent();
            $table->timestamp('video_category_updated_at')->nullable()->default(null); // Set default value to NULL;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_category_mappings');
    }
}
