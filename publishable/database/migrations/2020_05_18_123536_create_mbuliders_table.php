<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMbulidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mbuilders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['dynamic', 'crud', 'url'])->default('url');
            $table->string('icon')->default('fas fa-file');
            $table->string('val');
            $table->string('permi')->nullable();
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
        Schema::dropIfExists('mbuilders');
    }
}
