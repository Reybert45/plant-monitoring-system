<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->unsignedInteger('suffix_id')->nullable();
            $table->foreign('suffix_id')->references('id')->on('suffixes')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedInteger('gender_id')->nullable();
            $table->foreign('gender_id')->references('id')->on('genders')->onUpdate('cascade')->onDelete('restrict');
            $table->date('birthdate');
            $table->timestamps();
        });

        \DB::table('people')->insert([
            'first_name' => 'Reybert',
            'middle_name' => 'NA',
            'last_name' => 'Lacio',
            'suffix_id' => 1,
            'gender_id' => 1,
            'birthdate' => '2002-02-22'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
