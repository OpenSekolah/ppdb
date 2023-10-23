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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->uuid('id')->primary();
            $table->uuid('register_form_id');
            $table->string('residence', 255);
            $table->text('address');
            $table->smallInteger('rt');
            $table->smallInteger('rw');
            $table->string('subdistrict', 255)->comment('Kecamatan');
            $table->string('province', 255)->comment('Provinsi');
            $table->string('postal_code', 50)->comment('Kode Pos');
            $table->string('address_coordinates', 50)->comment('Koordinat Alamat');
            $table->string('transportation', 255)->comment('Transportasi');
            $table->string('distance', 255)->comment('Jarak');
            $table->string('traveling_time', 255)->comment('Waktu Tempuh');
            $table->timestamps();
            $table->foreign('register_form_id')->references('id')->on('register_forms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
