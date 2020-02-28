<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("title", 32);
            $table->string('short_desc',92);
            $table->string('long_desc',255)->nullable();
            $table->unsignedBigInteger('state')->default(1);
            $table->foreign('state')->references('id')->on('estados');
            $table->unsignedBigInteger('leader');
            $table->foreign('leader')->references('id')->on('members');
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
        Schema::dropIfExists('projects');
    }
}
