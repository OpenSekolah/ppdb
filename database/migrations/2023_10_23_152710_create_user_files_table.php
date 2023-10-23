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
        Schema::create('user_files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('register_form_id');
            $table->string('name', 255)->comment('Nama Berkas');
            $table->string('file', 255)->comment('Berkas');
            $table->enum('file_type', ['foto', 'kk', 'akta_kelahiran', 'ijazah', 'kip'])->comment('Tipe Data');
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
        Schema::dropIfExists('user_files');
    }
};
