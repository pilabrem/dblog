<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->bigInteger('entity_id');
            $table->string('table_name');
            $table->json('data');
            $table->ipAddress('ip');
            $table->string('user_agent');
            $table->string('location');
            $table->enum('action', ['create', 'read', 'update', 'delete']);
            $table->string('message');
            $table->timestamps();

            // Creating index
            $table->index('user_id');
            $table->index('entity_id');
            $table->index('table_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
