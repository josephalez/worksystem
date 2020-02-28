<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssistancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('office')->default(0);
            $table->foreign('office')->references('id')->on('offices');
            $table->unsignedBigInteger('member')->default(0);
            $table->foreign('member')->references('id')->on('members');
            $table->date('date');
            $table->dateTime('entry');
            $table->dateTime('leave')->nullable();
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
        Schema::dropIfExists('assistances');
    }
}
