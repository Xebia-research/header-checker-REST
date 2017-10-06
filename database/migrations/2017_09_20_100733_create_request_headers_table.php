<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_headers', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('request_id');
            $table->foreign('request_id')
                ->references('id')->on('requests');

            $table->string('name');
            $table->mediumText('value');

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
        Schema::dropIfExists('request_headers');
    }
}
