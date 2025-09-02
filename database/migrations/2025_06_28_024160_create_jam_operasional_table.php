<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jam_operasional', function (Blueprint $table) {
            $table->id();
            $table->string('hari');
            $table->time('mulai');
            $table->time('selesai');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jam_operasional');
    }
};


