<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCvformTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cvform', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nrc_code');
            $table->string('nrc_state');
            $table->string('nrc_status');
            $table->string('nrc');
            $table->string('fullnrc');
            $table->string('dob');
            $table->string('edu');
            $table->string('religion');
            $table->string('gender');
            $table->string('marrical_status');
            $table->string('email');
            $table->string('fName');
            $table->string('fPhone');
            $table->string('experience');
            $table->string('job');
            $table->string('department');
            $table->string('exp_salary');
            $table->string('hostel');
            $table->string('applied_date');
            $table->string('address');
            $table->string('phone');
            $table->string('photo');
            $table->string('signature');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('cvform');
    }
}
