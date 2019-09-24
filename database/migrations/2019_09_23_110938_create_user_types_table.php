<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTypesTable extends Migration
{

    public function up()
    {
        Schema::create('user_types', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('level');
            $table->string('description');
            $table->softDeletes();
            $table->timestamps();
            $table->integer('updated_by')->reference('id')->on('users');
        });
    }

    public function down()
    {
        Schema::drop('user_types');
    }
}
