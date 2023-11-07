<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuffixesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suffixes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        $suffixes_list = ["NA","Jr.","Sr.","I","II","II","IV","V","VI","VII","VIII","IX","X"];
        foreach($suffixes_list as $suffix) {
            \DB::table('suffixes')->insert([
                'name' => $suffix
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
        Schema::dropIfExists('suffixes');
    }
}
