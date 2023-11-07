<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFertilizersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fertilizers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        $fertilizers_arr = ['Garden Soil', 'Carbonized Rice Hull', 'Nitrogen', 'Bio-organic', 'Inorganic', 'High-Phosphorus', 'Comfrey', 'Liquid', 'Dynamite', 'Soluble'];
        foreach($fertilizers_arr as $fertilizer) {
            \DB::table('fertilizers')->insert([
                'name' => $fertilizer
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
        Schema::dropIfExists('fertilizers');
    }
}
