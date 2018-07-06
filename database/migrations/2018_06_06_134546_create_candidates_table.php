<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students');
            $table->unsignedInteger('position_id');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->unsignedInteger('party_id');
            $table->foreign('party_id')->references('id')->on('parties');
            $table->string('candidacy_image')->unique()->nullable();
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
        Schema::dropIfExists('candidates');
    }
}
