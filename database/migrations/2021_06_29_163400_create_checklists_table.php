<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklists', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('color');
            $table->string('detail')->nullable();
            $table->boolean('account'); // bride or groom
            $table->integer('budget')->default('0');
            $table->boolean('urgent')->default(false);
            $table->boolean('archived')->default(false);
            $table->foreignId('user_id')->constrained(); //tasker
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
        Schema::dropIfExists('checklists');
    }
}
