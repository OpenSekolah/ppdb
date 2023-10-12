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
        Schema::create('admissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->year('year')->comment('Tahun');
            $table->smallInteger('stage')->comment('Gelombang');
            $table->smallInteger('quota')->comment('Kuota Penerimaan Siswa');
            $table->date('start_date')->comment('Mulai Tanggal');
            $table->date('end_date')->comment('Berakhir Tanggal');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['year', 'stage'], 'unique_yest');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admissions');
    }
};
