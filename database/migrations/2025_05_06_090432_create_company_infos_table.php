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
        Schema::create('company_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('company')->nullable();
            $table->string('email_1')->nullable();
            $table->string('email_2')->nullable();
            $table->string('phone_1')->nullable();
            $table->string('phone_2')->nullable();
            $table->string('address')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('city_sr')->nullable();
            $table->string('city_en')->nullable();
            $table->string('country_sr')->nullable();
            $table->string('country_en')->nullable();
            $table->string('website')->nullable();
            $table->integer('tax_no')->nullable();
            $table->integer('company_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_info');
    }
};
