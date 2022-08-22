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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("productThumb",200);
            $table->string("productName",200);
            $table->integer("productPrice");
            $table->integer("productDiscount");
            $table->unsignedBigInteger("productcat_id");
            $table->foreign("productcat_id")->references("id")->on("productcats")->onDelete("cascade");
            $table->string("productCreate",200);
            $table->string("productTime",200);
            $table->string("productStatus",200);
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
        Schema::dropIfExists('products');
    }
};
