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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade'); // users table id is foreign key
            $table->string('title');
            $table->string('image');
            $table->date('release_date');
            $table->string('genre'); // | separated
            $table->string('director');
            $table->string('actors'); // comma separated
            $table->date('watched_date');
            $table->integer('rating');
            $table->longText('comments');
            $table->timestamps();
            $table->string('tmdb_id');
            $table->string('tmdb_rating');
            $table->boolean('cinema')->default(false);
            $table->boolean('friends')->default(false);
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
};
