<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kasets', function (Blueprint $table) {
            $table->id();
            $table->integer('kategori_kaset_id');
            $table->integer('distributor_id');
            $table->integer('rak_id');
            $table->string('judul');
            $table->text('deskripsi');
            $table->integer('jumlah');
            $table->integer('harga_beli');
            $table->integer('harga_sewa');
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
        Schema::dropIfExists('kasets');
    }
}
