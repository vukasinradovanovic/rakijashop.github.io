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
            $table->unsignedBigInteger('reviewer_id');
            $table->foreign('reviewer_id')->references('id')->on('users')->onDelete('cascade');;
            $table->unsignedBigInteger('reviewed_user_id');
            $table->foreign('reviewed_user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->longtext('comment')->nullable();
            $table->tinyInteger('rating');
            $table->unique(['reviewer_id', 'reviewed_user_id']);
            $table->timestamps();
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
