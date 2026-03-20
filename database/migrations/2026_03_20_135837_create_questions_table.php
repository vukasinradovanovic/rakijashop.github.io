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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('name');
            $table->string('email');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('question_types');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('question_statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
