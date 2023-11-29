<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGardeningEssentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gardening_essentials', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('plant_id')->nullable();
            $table->foreign('plant_id')->references('id')->on('plants')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('essential_type_id')->nullable();
            $table->foreign('essential_type_id')->references('id')->on('essential_types')->onUpdate('cascade')->onDelete('restrict');
            $table->longText('link');
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
        Schema::dropIfExists('gardening_essentials');
    }
}
