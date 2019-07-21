<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePullLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pull_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('c_phone', 20)->nullable();
            $table->string('account_number', 50)->nullable();
            $table->string('r_phone', 20)->nullable();
            $table->string('name', 50)->nullable();
            $table->string('product', 100)->nullable();
            $table->text('request_data')->nullable();
            $table->boolean('status')->default(1);
            $table->string('response', 200)->nullable();
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
        Schema::dropIfExists('pull_logs');
    }
}
