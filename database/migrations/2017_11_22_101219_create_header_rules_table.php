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

            $table->mediumText('description')
                ->nullable();

            $table->enum('validation_type', [
                'required',
                'prohibit',
                'equal',
                'regex',
            ]);

            $table->mediumText('validation_value')
                ->nullable();

            $table->enum('risk_level', [
                '-',
                'low',
                'medium',
                'high',
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
