<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('qone_enunciated');
            $table->string('qone_response');
            $table->string('qtwo_enunciated');
            $table->string('qtwo_response');
            $table->string('qthree_enunciated');
            $table->string('qthree_response');
            $table->string('qfour_enunciated');
            $table->string('qfour_response');
            $table->string('qfive_enunciated');
            $table->string('qfive_response');
            $table->string('qsix_enunciated');
            $table->string('qsix_response');
            $table->string('qseven_enunciated');
            $table->string('qseven_response');
            $table->string('alert_text');
            $table->float('points_covid');
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
        Schema::dropIfExists('formssee');
    }
}
