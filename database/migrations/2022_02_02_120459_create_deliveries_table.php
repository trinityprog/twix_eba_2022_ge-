<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();

            $table->string('surname')->nullable();
            $table->string('name')->nullable();
            $table->string('index')->nullable();
            $table->foreignId('region_id')->nullable()->constrained('delivery_regions');
            $table->string('locality')->nullable();
            $table->string('street')->nullable();
            $table->string('building')->nullable();
            $table->string('apartament')->nullable();
            $table->text('commentary')->nullable();
            $table->foreignId('user_id')->constrained();

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
        Schema::dropIfExists('deliveries');
    }
}
