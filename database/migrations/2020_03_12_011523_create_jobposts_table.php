<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobpostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobposts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jobtitle');
            $table->string('refno'); 
            $table->string('joblocation');
            $table->longText('jobdescription');
            $table->string('experiencelevel');
            $table->longText('skillrequired');
            $table->longText('duties');
            $table->string('salaryrange');
            $table->string('numberofposts');
            $table->string('deadline'); 
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
        Schema::dropIfExists('jobposts');
    }
}
