<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('representative_id')->constrained();
            $table->string('shop_name');
            $table->foreignId('area_id')->constrained();
            $table->foreignId('genre_id')->constrained();
            $table->text('shop_summary');
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
        Schema::dropIfExists('shops');
    }
}
