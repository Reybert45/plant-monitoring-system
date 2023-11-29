<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plant_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->date('planting_date');
            $table->date('harvest_date');
            $table->string('location');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->unsignedBigInteger('plant_status_id')->nullable();
            $table->foreign('plant_status_id')->references('id')->on('plant_statuses')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('life_cycle_stage_id')->nullable();
            $table->foreign('life_cycle_stage_id')->references('id')->on('life_cycle_stages')->onUpdate('cascade')->onDelete('restrict');
            $table->string('image_url');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('people')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('fertilizer_id')->nullable();
            $table->foreign('fertilizer_id')->references('id')->on('fertilizers')->onUpdate('cascade')->onDelete('restrict');
            $table->dateTime('watering_schedule');
            $table->tinyInteger('is_harvested')->default(0);
            $table->integer('quantity_harvested')->default(0);
            $table->string('sow_depth');
            $table->string('distance_between_plants');
            $table->string('lowest_temperature');
            $table->string('highest_temperature');
            $table->string('days_before_germination');
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->tinyInteger('is_verified')->default(0); // Pending - 0, Approved - 1, Disapproved - 2
            $table->tinyInteger('is_img_default')->default(0);
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
        Schema::dropIfExists('plant_requests');
    }
}
