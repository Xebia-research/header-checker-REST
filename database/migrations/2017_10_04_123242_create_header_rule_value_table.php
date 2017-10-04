<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeaderRuleValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('header_rule_value', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('header_rule_id')
                ->unsigned();

            $table->foreign('header_rule_id')
                ->references('id')->on('header_rules');

            $table->enum('value_type', ['equals','equals_regex']);
            $table->string('value');

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
        Schema::dropIfExists('header_rule_value');
    }
}
