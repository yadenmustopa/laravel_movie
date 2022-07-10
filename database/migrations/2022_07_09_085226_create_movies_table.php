<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('poster');
            $table->decimal('rating')->default(0.00);
            $table->enum('genre',['action','romance','anime','horor','drama','crime','comedy','fantasy'])->default('action');
            $table->dateTime("created_at", $precision = 0);
            $table->dateTime("updated_at", $precision = 0 );
            $table->index('title');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
