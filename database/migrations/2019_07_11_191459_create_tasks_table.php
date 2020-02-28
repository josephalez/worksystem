<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',24);
            $table->string('description',92)->nullable();
            $table->dateTime('expiration')->nullable();
            $table->unsignedBigInteger('project');
            $table->foreign('project')->references('id')->on('projects');
            $table->unsignedBigInteger('supervisor')->nullable();
            $table->foreign('supervisor')->references('id')->on('members');
            $table->unsignedBigInteger('owner')->nullable();
            $table->foreign('owner')->references('id')->on('members');
            $table->unsignedBigInteger('state')->default(7);
            $table->foreign('state')->references('id')->on('estados');
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
        Schema::dropIfExists('tasks');
    }
}
