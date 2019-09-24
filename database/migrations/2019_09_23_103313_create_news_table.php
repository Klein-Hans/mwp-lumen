<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{

    public function up()
    {
        Schema::create('news', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('article');
            $table->integer('file_id');
            $table->date('published_date');
            $table->string('published_by');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('updated_by')->reference('id')->on('users');
        });
    }

    public function down()
    {
        Schema::drop('News');
    }
}
