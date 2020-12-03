<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLadconfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('heroconfs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['switch', 'input'])->default('switch');
            $table->string('display_name');
            $table->string('val');
            $table->mediumText('desc')->nullable();
            $table->string('default_val');
            $table->integer('que');
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
        Schema::dropIfExists('heroconfs');
    }
}
