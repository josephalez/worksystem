<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name',24)->unique();

            $table->decimal('percentage')->default(0); //Aqui cobrando 0%
            $table->decimal('percentage_max')->default(0); //Si esta en 0, se sobreentiende hay 1 solo porcentaje

            //Ah! esto de aqui va el la tabla pivote "Etapas_Proyectos_Miembros"
            //$table->enum('process',['noactions','cancel','process','complete']); //Algun dia podemos hacer que estos sean otra referencia mas a la tabla estado...

            $table->unsignedBigInteger('phase')->nullable();
            $table->foreign('phase')->references('id')->on('phases');

            $table->unsignedBigInteger('sback')->nullable();
            $table->foreign('sback')->references('id')->on('stages');

            $table->unsignedBigInteger('snext')->nullable();
            //No puedo hacer de estas una llave foranea... ¿por que?, por que deben estar creadas ANTES.
            //$table->foreign('snext')->references('id')->on('stages');

            $table->unsignedBigInteger('sparalel')->nullable();
            //No puedo hacer de estas una llave foranea... ¿por que?, por que deben estar creadas ANTES.
            //$table->foreign('sparalel')->references('id')->on('stages');

            $table->string('description',128)->nullable();

            $table->boolean('trash')->default(false);
            $table->boolean('active')->default(true); //si pues, luego lo usaremos

            $table->boolean('optional')->default(false);
            $table->boolean('bidirectional')->default(false);

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
        Schema::dropIfExists('stages');
    }
}
