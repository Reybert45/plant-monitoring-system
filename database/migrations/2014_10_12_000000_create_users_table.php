<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('person_id')->nullable();
            $table->foreign('person_id')->references('id')->on('people')->onUpdate('cascade')->onDelete('restrict');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('secret_key');
            $table->tinyInteger('is_active')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        \DB::table('users')->insert([
            'person_id' => 1,
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => \Hash::make('user123'),
            'secret_key' => 'user123'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
