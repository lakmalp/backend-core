<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_audits', function (Blueprint $table) {
            $table->id();
            $table->string('model', 50);
            $table->unsignedBigInteger('model_id');
            $table->string('before_json', 2000)->nullable();
            $table->string('after_json', 2000)->nullable();
            $table->unsignedBigInteger('by_user_id');
            $table->timestamps();

            $table->foreign('by_user_id')->references('id')->on('model_audits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_audits');
    }
}
