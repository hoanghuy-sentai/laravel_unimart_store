<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postcats', function (Blueprint $table) {
            $table->id();
            $table->string("catName",200);
            $table->integer("qtyPost");
            $table->string("catStatus",200);
            $table->string("catCreate",200);
            $table->string("catTime",20);
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
        Schema::dropIfExists('postcats');
    }
};
