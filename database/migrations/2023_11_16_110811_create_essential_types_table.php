<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEssentialTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('essential_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        $essentials_type_list = ['Sow Depth', 'Distance Between Plants', 'Days Before Germination', 'Harvest In', 'Lowest Temperature', 'Highest Temperature'];
        foreach($essentials_type_list as $essential_type) {
            \DB::table('essential_types')->insert([
                'name' => $essential_type,
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
        Schema::dropIfExists('essential_types');
    }
}
