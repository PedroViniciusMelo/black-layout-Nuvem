<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ports', function (Blueprint $table) {
            $table->id();

            $table->string('ip')->nullable(true);
            $table->string('privatePort')->nullable(true);
            $table->string('publicPort')->nullable(true);
            $table->string('type')->nullable(true);
            $table->json('networkSettings')->nullable(true);

            $table->unsignedBigInteger('container_id');
            $table->foreign('container_id')->references('id')->on('containers');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ports');
    }
}
