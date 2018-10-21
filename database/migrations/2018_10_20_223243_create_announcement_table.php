<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->double('price');
            $table->integer('quantity');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('announcement_status_id');
            $table->boolean('local_withdraw');
            $table->dateTime('begin_date');
            $table->dateTime('end_data');
            $table->timestamps();

            $table->foreign('product_id')
                ->references('id')->on('products');

            $table->foreign('user_id')
                ->references('id')->on('users');

            $table->foreign('announcement_status_id')
                ->references('id')->on('announcement_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcement');
    }
}
