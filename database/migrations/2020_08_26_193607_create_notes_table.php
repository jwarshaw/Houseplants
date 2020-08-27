<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date')->nullable();
            $table->integer('height_inches')->nullable();
            $table->integer('water_cups')->nullable();

            $table->unsignedInteger('houseplant_id')->nullable();
            $table->foreign('houseplant_id')
                ->references('id')
                ->on('houseplants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
