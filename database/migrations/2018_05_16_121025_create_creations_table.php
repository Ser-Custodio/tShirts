<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("shirt_id");
            $table->integer("logo_id");
            $table->foreign("shirt_id")->references("id")->on("tshirts");
            $table->foreign("logo_id")->references("id")->on("logos");
            $table->integer("user_id");
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
        Schema::dropIfExists('creations');
    }
}
