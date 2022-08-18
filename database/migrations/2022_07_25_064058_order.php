<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->integer('luas');
            $table->text('alamat_lahan');
            $table->text('kegiatan');
            $table->decimal('latitude', 10 , 2);
            $table->decimal('longtitude', 11 , 2);
            $table->foreignId('bibit_id')->constrained('bibit');
            $table->foreignId('pemohon_id')->constrained('pemohon');
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
        Schema::dropIfExists('order');
    }
};
