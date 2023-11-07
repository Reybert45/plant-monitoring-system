<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLifeCycleStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('life_cycle_stages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        $life_cycle_stages_list = ["Seeding","Flowering","Fruiting"];
        foreach($life_cycle_stages_list as $plant_status) {
            \DB::table('life_cycle_stages')->insert([
                'name' => $plant_status
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('life_cycle_stages');
    }
}
