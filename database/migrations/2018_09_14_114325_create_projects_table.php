<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('address');
            $table->integer('city_id')->nullable();
            $table->integer('township_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->string('project_type');
            $table->string('youtube_url')->nullable();
            $table->string('remarks')->nullable();
            $table->boolean('has_amenity')->nullable();
            $table->boolean('has_nearby')->nullable();
            $table->boolean('has_facade')->nullable();
            $table->boolean('has_location_image')->nullable();
            $table->boolean('has_floor_plan')->nullable();
            $table->boolean('has_model_unit')->nullable();
            $table->boolean('has_unit_layout')->nullable();
            $table->boolean('has_brochure')->nullable();
            $table->boolean('has_region')->nullable();
            $table->boolean('has_city')->nullable();
            $table->boolean('has_township')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
