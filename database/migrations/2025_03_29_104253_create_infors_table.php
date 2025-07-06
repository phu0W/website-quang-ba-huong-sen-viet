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
        Schema::create('infors', function (Blueprint $table) {
            $table->id();
            $table->string('phone1', 10)->nullable();
            $table->string('phone2', 10)->nullable();
            $table->string('fb', 100)->nullable();
            $table->string('logo', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infors');
    }
};
