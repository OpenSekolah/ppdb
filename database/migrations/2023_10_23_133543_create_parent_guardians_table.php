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
        Schema::create('parent_guardians', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('register_form_id');
            $table->string('status', 255)->comment('Status');
            $table->string('nik', 150)->comment('Nik');
            $table->string('name', 255)->comment('Nama orangtua wali');
            $table->string('place_of_birth', 255)->comment('Tempat Lahir');
            $table->date('date_of_birth')->comment('Tanggal Lahir');
            $table->string('education', 255)->comment('Pendidikan');
            $table->string('work', 255)->comment('Pekerjaan');
            $table->string('income', 255)->comment('Penghasilan');
            $table->string('phone', 100)->nullable()->default(null)->comment('No. HP');
            $table->enum('data_type', ['ayah', 'ibu', 'wali'])->comment('Tipe Data');
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
        Schema::dropIfExists('parent_guardians');
    }
};
