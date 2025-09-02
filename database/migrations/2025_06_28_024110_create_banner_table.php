<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('banner', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('foto');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('banner');
    }
};


