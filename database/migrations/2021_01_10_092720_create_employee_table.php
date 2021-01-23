<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
            $table->integer('dep_id');
            $table->integer('position_id');
            $table->string('name');
            $table->string('gender');
            $table->string('father_name');
            $table->string('phone_no');
            $table->string('nrc_code');
            $table->string('nrc_state');
            $table->string('nrc_status');
            $table->string('nrc');
            $table->string('fullnrc');
            $table->string('date_of_birth');
            $table->string('join_date');
            $table->string('join_month');
            $table->string('address');
            $table->string('city');
            $table->string('township');
            $table->string('qualification');
            $table->string('salary')->nullable();
            $table->string('photo');
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
        Schema::dropIfExists('employee');
    }
}
