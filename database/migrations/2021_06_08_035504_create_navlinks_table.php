<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavlinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navlinks', function (Blueprint $table) {
            $table->id();
            $table->string('group');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('icon')->nullable();
            $table->string('info')->nullable();
            $table->boolean('active')->default(true);
            $table->tinyInteger('sequence')->default(1);
            $table->boolean('hasChild')->default(false);
            $table->foreignId('parent_id')->nullable()->onDelete('set null');
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
        Schema::dropIfExists('navlinks');
    }
}
