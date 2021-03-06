<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function(Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password')->nullable();
            $table->string('email')->nullable();
            $table->string('type')->default('Student');
            $table->string('image')->unique()->nullable();
            $table->boolean('has_voted')->default(false);
            $table->unsignedInteger('notifications_received')->default(0);
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
        Schema::dropIfExists('accounts');
    }
}
