<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('used')->default(0);
            $table->char('nickname', 100)->nullable();
            $table->char('avatar', 255)->nullable();
            $table->char('alias', 100)->nullable();
            $table->integer('province')->nullable();
            $table->integer('city')->nullable();
            $table->integer('area')->nullable();
            $table->integer('login_ip')->nullable();
            $table->integer('register_ip')->nullable();
            $table->integer('type_id');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
