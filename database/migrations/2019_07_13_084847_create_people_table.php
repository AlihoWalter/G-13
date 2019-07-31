<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->string('identity');
            $table->string('name');
            $table->string('sex');
            $table->string('district');
            $table->string('recommender_id');
            $table->date('date');
            
            $table->string('signature');
            $table->integer('role');
            $table->integer('salary');
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
        Schema::dropIfExists('people');
    }
}
