<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{

    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('type')->nullable();
            $table->string('category')->nullable();
            $table->string('size');
            $table->string('path');
            $table->softDeletes();
            $table->timestamps();
            $table->integer('updated_by')->reference('id')->on('users');
        });
    }

    public function down()
    {
        Schema::drop('files');
    }
}
