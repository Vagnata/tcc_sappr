<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAnnouncementsTable extends Migration
{
    public function up()
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->string('phone', '50');
            $table->string('address', '255');
            $table->integer('current_quantity');
        });
    }

    public function down()
    {
        //
    }
}
