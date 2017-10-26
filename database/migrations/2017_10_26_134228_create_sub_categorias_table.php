<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categorias', function (Blueprint $table) {
            $table->increments('id_sub');
            $table->string('nombre_sub');
            $table->integer('id_categoria_fk')->unsigned();
            $table->integer('activo_sub');
            $table->timestamps();
        });
        Schema::table('sub_categorias', function($table) {
            $table->foreign('id_categoria_fk')->references('id')->on('categorias');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_categorias');
    }
}
