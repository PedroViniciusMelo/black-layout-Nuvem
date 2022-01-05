<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo')->nullable();
            $table->string('website')->nullable();
            $table->string('description', 10240);
            $table->string('fromImage');
            $table->string('fromSrc')->nullable();
            $table->string('repo')->nullable();
            $table->string('tag');
            $table->string('message')->nullable();
            $table->string('user_type');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
