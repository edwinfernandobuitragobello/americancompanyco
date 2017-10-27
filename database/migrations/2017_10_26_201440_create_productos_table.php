<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id_prod');
            $table->string('foto');
            $table->string('nombre_prod');
            $table->longText('descripcion_prod');
            $table->string('precio');
            $table->integer('id_subcategoria_fk')->unsigned();
            $table->integer('id_categoria_fk')->unsigned();
            $table->integer('activo_prod');
            $table->timestamps();
        });
        Schema::table('productos', function($table) {
            $table->foreign('id_subcategoria_fk')->references('id_sub')->on('sub_categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
