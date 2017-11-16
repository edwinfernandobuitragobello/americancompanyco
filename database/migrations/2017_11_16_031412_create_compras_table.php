<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('email');
            $table->string('telefono');
            $table->longText('pedido');
            $table->string('merchant_id');
            $table->string('referenceCode');
            $table->string('TX_VALUE');
            $table->string('New_value');
            $table->string('currency');
            $table->string('transactionState');
            $table->string('firma_cadena');
            $table->string('firmacreada');
            $table->string('firma');
            $table->string('reference_pol');
            $table->string('cus');
            $table->string('extra1');
            $table->string('pseBank');
            $table->string('lapPaymentMethod');
            $table->string('transactionId');
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
        Schema::dropIfExists('compras');
    }
}
