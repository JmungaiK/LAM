<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id'); // Change to bigIncrements for compatibility with user_progress
            $table->string('user_name');
            $table->string('user_email')->unique();
            $table->string('user_password');
            $table->enum('user_role', ['user', 'moderator', 'admin'])->default('user');
            $table->timestamp('user_created_at')->useCurrent();
            $table->timestamp('user_updated_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
