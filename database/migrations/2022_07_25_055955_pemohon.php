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
        Schema::create('pemohon', function (Blueprint $table) {
            $table->id();
            $table->enum('satuan', ['kelompok','perorangan']);
            $table->string('nama_pemohon');
            $table->string('kelompok')->nullable();
            $table->text('alamat');
            $table->text('no_telp');
            $table->text('kegiatan');
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
        Schema::dropIfExists('pemohon');
    }
};
