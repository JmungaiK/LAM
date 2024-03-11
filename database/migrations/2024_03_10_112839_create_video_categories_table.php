<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_categories', function (Blueprint $table) {
            $table->bigIncrements('video_category_id');
            $table->string('video_category_name');
            $table->text('video_category_description')->nullable();
            $table->timestamp('video_category_created_at')->useCurrent();
            $table->timestamp('video_category_updated_at')->useCurrent()->nullable()->onUpdate('CURRENT_TIMESTAMP');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_categories');
    }
}
