<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('unity_type_id');
            $table->unsignedInteger('product_status_id');
            $table->string('name');
            $table->string('image_path')->nullable();
            $table->timestamps();

            $table->foreign('unity_type_id')
                ->references('id')->on('unity_types');

            $table->foreign('product_status_id')
                ->references('id')->on('product_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
