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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("productThumb",200);
            $table->string("productName",200);
            $table->integer("qty");
            $table->integer("price");
            $table->integer("subtotal");
            $table->integer("total");
            $table->unsignedBigInteger("customer_id");
            $table->foreign("customer_id")->references("id")->on("customers")->onDelete("cascade");
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
        Schema::dropIfExists('orders');
    }
};
