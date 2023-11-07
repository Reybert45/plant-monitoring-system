<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('person_id');
            $table->foreign('person_id')->references('id')->on('people')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedInteger('address_status_id');
            $table->foreign('address_status_id')->references('id')->on('address_statuses')->onUpdate('cascade')->onDelete('restrict');
            $table->string('street_id');
            $table->foreign('street_id')->references('id')->on('streets')->onUpdate('cascade')->onDelete('restrict');
            $table->string('barangay_id');
            $table->foreign('barangay_id')->references('id')->on('barangays')->onUpdate('cascade')->onDelete('restrict');
            $table->string('region_id');
            $table->foreign('region_id')->references('id')->on('regions')->onUpdate('cascade')->onDelete('restrict');
            $table->string('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('cascade')->onDelete('restrict');
            $table->string('province_id');
            $table->foreign('province_id')->references('id')->on('provinces')->onUpdate('cascade')->onDelete('restrict');
            $table->string('zipcode_id');
            $table->foreign('zipcode_id')->references('id')->on('zipcodes')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });

        \DB::table('addresses')->insert([
            'person_id' => 1,
            'address_status_id' => 1,
            'street_id' => 1,
            'region_id' => 1,
            'barangay_id' => 1,
            'city_id' => 1,
            'province_id' => 1,
            'zipcode_id' => 1
        ]);

        \DB::table('addresses')->insert([
            'person_id' => 1,
            'address_status_id' => 2,
            'street_id' => 1,
            'barangay_id' => 1,
            'city_id' => 1,
            'province_id' => 1,
            'zipcode_id' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
