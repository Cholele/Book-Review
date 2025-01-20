<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            $table->text('review');
            $table->unsignedTinyInteger('rating');  

            $table->timestamps();

            //Implementing Foreign Keys
            /* On cascade means that when a record in Book is deleted, then all the records associated with that book will
            be deleted too */
            $table->unsignedBigInteger('book_id');       // <------- This is the column that will be use as Foreign Key
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');

            //There's a shorter sintax that we can use in order to create the relationship
            // $table->foreignId('book_id')->constrained()->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
