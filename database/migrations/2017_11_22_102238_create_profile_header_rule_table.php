<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileHeaderRuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_header_rule', function (Blueprint $table) {
            $table->unsignedInteger('profile_id');
            $table->foreign('profile_id')
                ->references('id')->on('profiles');

            $table->unsignedInteger('header_rule_id');
            $table->foreign('header_rule_id')
                ->references('id')->on('header_rules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_header_rule');
    }
}
