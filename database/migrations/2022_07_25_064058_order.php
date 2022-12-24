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
            $table->decimal('latitude', 10 , 6);
            $table->decimal('longitude', 11 , 6);
            $table->integer('total');
            $table->string('status');
            $table->unsignedBigInteger('pemohon_id');
            $table->timestamps();

            $table->foreign('pemohon_id')->references('id')->on('pemohon');
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
