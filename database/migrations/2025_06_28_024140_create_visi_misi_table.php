<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('visi_misi', function (Blueprint $table) {
            $table->id();
            $table->longText('visi');
            $table->longText('misi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visi_misi');
    }
};


