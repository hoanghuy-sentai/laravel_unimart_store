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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string("postThumb",200);
            $table->string('postTitle',200);
            $table->unsignedBigInteger("cat_id");
            $table->foreign("cat_id")->references("id")->on("postcats")->onDelete("cascade");
            $table->string("postCreate",200);
            $table->string("postTime",200);
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
        Schema::dropIfExists('posts');
    }
};
