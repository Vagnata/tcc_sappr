<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('announcement_id');
            $table->unsignedInteger('user_id')->comment('ID do usuário que fez a compra');
            $table->unsignedInteger('payment_type_id')->nullable();
            $table->unsignedInteger('sale_status_id');
            $table->integer('quantity');
            $table->double('price');
            $table->double('discount')->nullable();
            $table->timestamps();

            $table->foreign('announcement_id')
                ->references('id')->on('announcements');

            $table->foreign('user_id')
                ->references('id')->on('users');

            $table->foreign('payment_type_id')
                ->references('id')->on('payment_types');

            $table->foreign('sale_status_id')
                ->references('id')->on('sale_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale');
    }
}
