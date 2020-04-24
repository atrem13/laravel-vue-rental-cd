<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyewaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyewaans', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id');
            $table->string('no_penyewaan');
            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');
            $table->integer('total_dp');
            $table->integer('total_sisa_pembayaran');
            $table->integer('denda');
            $table->integer('status');
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
        Schema::dropIfExists('penyewaans');
    }
}
