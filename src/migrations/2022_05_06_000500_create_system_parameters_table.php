<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_parameters', function (Blueprint $table) {
            $table->id();
            $table->string('param_type', 15);
            $table->string('code', 100)->unique();
            $table->string('description', 300);
            $table->string('value_type', 20);
            $table->string('value', 1000)->nullable();
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
        Schema::dropIfExists('system_parameters');
    }
}
