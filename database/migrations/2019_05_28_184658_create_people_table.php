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
            $table->string('firstname',48);
            $table->string('lastname',48)->nullable();
            $table->string('lenguague',4)->nullable(); //Codigo de idioma ('es','en'...)
            $table->string('email',190);
            $table->enum('source',['manually','form']);
            $table->string('phone',16)->nullable();
            $table->boolean('trash')->default(0);
            $table->boolean('lead')->default(0); //Es un lead?
            $table->string("message",255)->nullable();
            $table->boolean('isMember')->default(0);
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
