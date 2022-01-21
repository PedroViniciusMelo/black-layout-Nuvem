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
            $table->string('private_port')->nullable(true);
            $table->string('public_port')->nullable(true);
            $table->string('type')->nullable(true);
            $table->json('network_settings')->nullable(true);

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
