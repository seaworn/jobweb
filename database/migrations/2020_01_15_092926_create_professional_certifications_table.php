<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionalCertificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_certifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('certificate_name');
            $table->string('issuing_body');
            $table->text('description');
            $table->date('issued_on');
            $table->date('expiry')->nullable();
            $table->string('file_path');
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professional_certifications');
    }
}
