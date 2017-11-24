<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeaderRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('header_rules', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->enum('validation_type', [
                'include',
                'exclude',
                'value',
                'regex',
            ]);

            $table->mediumText('validation_value')
                ->nullable();

            $table->enum('risk_level', [
                'low',
                'moderate',
                'high',
                'critical',
            ]);

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
        Schema::dropIfExists('header_rules');
    }
}
