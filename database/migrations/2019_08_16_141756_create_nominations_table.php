<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNominationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nominations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('business_name');
            $table->string('first_name');
            $table->string('last_name');
            $table->boolean('in_dufferin');
            $table->boolean('is_member')->nullable();
            $table->string('nomination');
            $table->string('years_in_business')->nullable();
            $table->integer('full_time_employees')->nullable();
            $table->boolean('is_non_profit')->nullable();
            $table->boolean('is_for_profit')->nullable();
            $table->boolean('five_years')->nullable();
            $table->boolean('under_40')->nullable();
            $table->boolean('confirmation_employees_10')->nullable();
            $table->boolean('confirmation_employees_under_10')->nullable();
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
        Schema::dropIfExists('nominations');
    }
}
