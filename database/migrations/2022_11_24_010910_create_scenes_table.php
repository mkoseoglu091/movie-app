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
        Schema::create('scenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade'); // users table id is foreign key
            $table->foreignId('movie_id')->constrained()->onUpdate('cascade')->onDelete('cascade'); // movie table id is foreign key
            $table->time('time');
            $table->longText('comments');
            $table->binary('screenshot');
            $table->timestamps();
            $table->string('extension');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scenes');
    }
};
