<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::modify
        // ('authors', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('surname');
        //     $table->dateTime('birthdate');
        //     $table->string('country', 32)->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
