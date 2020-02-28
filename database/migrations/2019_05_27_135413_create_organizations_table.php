<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',24);
            $table->string('short_desc',92)->nullable();
            $table->string('long_desc',256)->nullable();
            $table->text('email')->nullable();
            $table->string('phone',16)->nullable();
            $table->string('photo')->nullable();
            $table->string('web')->nullable();
            $table->unsignedBigInteger('estado')->default(1);
            $table->foreign('estado')->references('id')->on('estados');
            $table->boolean('trash')->default(0);
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
        Schema::dropIfExists('organizations');
    }
}
