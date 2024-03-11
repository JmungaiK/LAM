<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministratorsTable extends Migration
{
    public function up()
    {
        Schema::create('administrators', function (Blueprint $table) {
            $table->bigIncrements('administrator_id');
            $table->unsignedBigInteger('user_id')->unique();
            $table->timestamp('administrator_created_at')->useCurrent();
            $table->timestamp('administrator_updated_at')->useCurrent()->nullable()->onUpdate('CURRENT_TIMESTAMP');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('administrators');
    }
}
