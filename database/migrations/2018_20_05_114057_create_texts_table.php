<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextsTable extends Migration
{
    public function up()
    {
        Schema::create('texts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->string('title')->nullable();
            $table->text('content_short')->nullable();
            $table->longText('content')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('texts');
    }
}
