<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            $table->integer('unit_type_id');
            $table->decimal('lowest_price', 12, 2);
            $table->decimal('highest_price', 12, 2)->nullable();
            $table->integer('lowest_size');
            $table->integer('highest_size')->nullable();
            $table->integer('updated_by')->reference('id')->on('users');
            $table->softDeletes();
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
        Schema::dropIfExists('units');
    }
}
