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
        Schema::create('register_forms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('admission_id');
            $table->unsignedBigInteger('user_id');
            $table->uuid('competence_first');
            $table->uuid('competence_second');
            $table->bigInteger('sequence_number');
            $table->string('register_number', 255);
            $table->string('name', 255);
            $table->string('nisn', 200)->unique();
            $table->string('place_of_birth', 200);
            $table->date('date_of_birth');
            $table->text('address');
            $table->string('from_school', 255);
            $table->enum('status', ['verified', 'accepted', 'reserved'])->default('verified');
            $table->timestamps();
            $table->foreign('admission_id')->references('id')->on('admissions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('competence_first')->references('id')->on('skill_competences')->onDelete('cascade');
            $table->foreign('competence_second')->references('id')->on('skill_competences')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('register_forms');
    }
};
