<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
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
            $table->timestamps();
        });

        $upo_desc = 'A coarse vine reaching a length of several meters. Leaves are rounded, 10 to 40 centimeters wide, softly hairy on both sides, 5-angled or lobed. Flowers, white, large, solitary, and monoecious or dioecious. Petals are ovate, 3 to 4 centimeters long.';
        $string_beans_desc = 'Is one of the most widely grown vegetables in the Philippines. It is a true legume and botanically more closely related to cowpea. The tender pods are edible while the skin is still smooth and before seeds mature or expand.';
        $petchay_desc = 'A leafy, shallow-rooted, cool-season crop but can stand higher tempera- tures given it is exposed to enough moisture. [1]. It is an erect, biennial herb, cultivated as an annual about 15-30cm tall in vegetative stage. The leaves are ovate, spirally and widely spread arranged.';
        $tomato_desc = 'Is globular or ovoid. Botanically, the fruit exhibits all of the common characteristics of berries; a simple fleshy fruit that encloses its seed in the pulp. The outer skin is a thin and fleshy tissue that comprises the remainder of the fruit wall as well as the placenta.';
        $cucumber_desc = 'Commonly mistaken for vegetables. But in fact its fruit, specifically berries. The long, green berries of the cucumber plant are what you usually find in your salads and sandwiches. They are made up of over 90% water, making them excellent for staying hydrated.';
        $kankong_desc = 'Also known as water glorybind, water spinach, water convolvulus, and swamp cabbage, is an important green leafy vegetable in Southeast Asia, Taiwan, and Malaysia. It is found throughout the fresh waters of southern China, and is cultivated in countries such as Ceylon.';
        $dynamite_desc = 'Also known as dynamite lumpia, among other names. It is a type of lumpia and it is commonly eaten as an appetizer or as a companion to beer.';
        $bombay_desc = 'An onion; a monocotyledonous plant (Allium cepa), allied to garlic, used as vegetable and spice.';
        $eggplant_desc = 'A tropical Old World solanaceous plant, Solanum melongena, widely cultivated for its egg-shaped typically dark purple fruit.';

        $today = date("Y-m-01");

        $plants_arr = [
            [
                'name' => 'Upo', 'description' => $upo_desc, 'image' => 'assets/images/plants/upo.jfif',
                'quantity' => 104,
                'days_before_germination' => '10-14 Days',
                'lowest_temperature' => '18°C',
                'highest_temperature' => '24°C',
                'location' => 'Garden 1',
                'plant_status_id' => 1,
                'life_cycle_stage_id' => 1,
                'fertilizer_id' => 1,
                'watering_schedule' => date('Y-m-d'),
                'sow_depth' => '34 Centimeters',
                'distance_between_plants' => '60 Centimeters',
                'planting_date' => date('Y-m-d'),
                'harvest_date' => date("Y-m-d", strtotime($today." +28 days") )
            ], 
            [
                'name' => 'String Beans', 'description' => $string_beans_desc, 'image' => 'assets/images/plants/string_beans.jfif',
                'quantity' => 427,
                'days_before_germination' => '8-10 Days',
                'lowest_temperature' => '14°C',
                'highest_temperature' => '32°C',
                'location' => 'Garden 2',
                'plant_status_id' => 1,
                'life_cycle_stage_id' => 2,
                'fertilizer_id' => 2,
                'watering_schedule' => date('Y-m-d'),
                'sow_depth' => '34 Centimeters',
                'distance_between_plants' => '60 Centimeters',
                'planting_date' => date('Y-m-d'),
                'harvest_date' => date("Y-m-d", strtotime($today." +15 days") )
            ], 
            [
                'name' => 'Pechay', 'description' => $petchay_desc, 'image' => 'assets/images/plants/petchay.jfif',
                'quantity' => 984,
                'days_before_germination' => '3-4 Days',
                'lowest_temperature' => '20°C',
                'highest_temperature' => '34°C',
                'location' => 'Garden 3',
                'plant_status_id' => 1,
                'life_cycle_stage_id' => 1,
                'fertilizer_id' => 3,
                'watering_schedule' => date('Y-m-d'),
                'sow_depth' => '34 Centimeters',
                'distance_between_plants' => '60 Centimeters',
                'planting_date' => date('Y-m-d'),
                'harvest_date' => date("Y-m-d", strtotime($today." +44 days") )
            ], 
            [
                'name' => 'Tomato', 'description' => $tomato_desc, 'image' => 'assets/images/plants/tomato.jfif',
                'quantity' => 134,
                'days_before_germination' => '5-10 Days',
                'lowest_temperature' => '21°C',
                'highest_temperature' => '24°C',
                'location' => 'Garden 4',
                'plant_status_id' => 1,
                'life_cycle_stage_id' => 2,
                'fertilizer_id' => 4,
                'watering_schedule' => date('Y-m-d'),
                'sow_depth' => '34 Centimeters',
                'distance_between_plants' => '60 Centimeters',
                'planting_date' => date('Y-m-d'),
                'harvest_date' => date("Y-m-d", strtotime($today." +18 days") )
            ], 
            [
                'name' => 'Cucumber', 'description' => $cucumber_desc, 'image' => 'assets/images/plants/cucumber.jfif',
                'quantity' => 235,
                'days_before_germination' => '3-10 Days',
                'lowest_temperature' => '20°C',
                'highest_temperature' => '30°C',
                'location' => 'Garden 5',
                'plant_status_id' => 1,
                'life_cycle_stage_id' => 1,
                'fertilizer_id' => 5,
                'watering_schedule' => date('Y-m-d'),
                'sow_depth' => '34 Centimeters',
                'distance_between_plants' => '60 Centimeters',
                'planting_date' => date('Y-m-d'),
                'harvest_date' => date("Y-m-d", strtotime($today." +12 days") )
            ], 
            [
                'name' => 'Kangkong', 'description' => $kankong_desc, 'image' => 'assets/images/plants/kangkong.jfif',
                'quantity' => 982,
                'days_before_germination' => '7-14 Days',
                'lowest_temperature' => '24°C',
                'highest_temperature' => '29°C',
                'location' => 'Garden 6',
                'plant_status_id' => 1,
                'life_cycle_stage_id' => 2,
                'fertilizer_id' => 6,
                'watering_schedule' => date('Y-m-d'),
                'sow_depth' => '34 Centimeters',
                'distance_between_plants' => '60 Centimeters',
                'planting_date' => date('Y-m-d'),
                'harvest_date' => date("Y-m-d", strtotime($today." +4 days") )
            ], 
            [
                'name' => 'Dynamite', 'description' => $dynamite_desc, 'image' => 'assets/images/plants/dynamite.jfif',
                'quantity' => 764,
                'days_before_germination' => '2-5 Days',
                'lowest_temperature' => '50°C',
                'highest_temperature' => '60°C',
                'location' => 'Garden 7',
                'plant_status_id' => 1,
                'life_cycle_stage_id' => 1,
                'fertilizer_id' => 7,
                'watering_schedule' => date('Y-m-d'),
                'sow_depth' => '34 Centimeters',
                'distance_between_plants' => '60 Centimeters',
                'planting_date' => date('Y-m-d'),
                'harvest_date' => date("Y-m-d", strtotime($today." +35 days") )
            ], 
            [
                'name' => 'Bombay', 'description' => $bombay_desc, 'image' => 'assets/images/plants/bombay.jfif',
                'quantity' => 896,
                'days_before_germination' => '2-5 Days',
                'lowest_temperature' => '29°C',
                'highest_temperature' => '35°C',
                'location' => 'Garden 8',
                'plant_status_id' => 1,
                'life_cycle_stage_id' => 2,
                'fertilizer_id' => 8,
                'watering_schedule' => date('Y-m-d'),
                'sow_depth' => '34 Centimeters',
                'distance_between_plants' => '60 Centimeters',
                'planting_date' => date('Y-m-d'),
                'harvest_date' => date("Y-m-d", strtotime($today." +87 days") )
            ], 
            [
                'name' => 'Eggplant', 'description' => $eggplant_desc, 'image' => 'assets/images/plants/eggplant.jfif',
                'quantity' => 653,
                'days_before_germination' => '7-12 Days',
                'lowest_temperature' => '20°C',
                'highest_temperature' => '30°C',
                'location' => 'Garden 9',
                'plant_status_id' => 1,
                'life_cycle_stage_id' => 1,
                'fertilizer_id' => 9,
                'watering_schedule' => date('Y-m-d'),
                'sow_depth' => '34 Centimeters',
                'distance_between_plants' => '60 Centimeters',
                'planting_date' => date('Y-m-d'),
                'harvest_date' => date("Y-m-d", strtotime($today." +48 days") )
            ],
        ];

        foreach($plants_arr as $plant) {
            \DB::table('plants')->insert([
                'image_url' => $plant['image'],
                'name' => $plant['name'],
                'description' => $plant['description'],
                'quantity' => $plant['quantity'],
                'lowest_temperature' => $plant['lowest_temperature'],
                'highest_temperature' => $plant['highest_temperature'],
                'location' => $plant['location'],
                'plant_status_id' => $plant['plant_status_id'],
                'life_cycle_stage_id' => $plant['life_cycle_stage_id'],
                'fertilizer_id' => $plant['fertilizer_id'],
                'watering_schedule' => $plant['watering_schedule'],
                'sow_depth' => $plant['sow_depth'],
                'distance_between_plants' => $plant['distance_between_plants'],
                'planting_date' => $plant['planting_date'],
                'harvest_date' => $plant['harvest_date'],
                'days_before_germination' => $plant['days_before_germination'],
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
        Schema::dropIfExists('plants');
    }
}
