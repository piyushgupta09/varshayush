<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('relation')->nullable();
            $table->integer('adults')->default('1');
            $table->integer('kids')->default('0');
            $table->string('address')->nullable();
            $table->string('note')->nullable();
            $table->string('travelby')->nullable();
            $table->string('contact')->nullable();
            $table->string('number')->nullable();
            $table->string('image')->nullable();
            $table->string('senior')->nullable();
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
        Schema::dropIfExists('guests');
    }
}
