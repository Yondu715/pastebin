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
        Schema::create('pastes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('text');
            $table->string('hash')->unique();
            $table->unsignedBigInteger('programming_language_id');
            $table->unsignedBigInteger('access_restriction_id');
            $table->unsignedBigInteger('author_id')->nullable()->default(null);
            $table->timestamp('expires_at')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('programming_language_id')->references('id')->on('programming_languages')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('access_restriction_id')->references('id')->on('access_restrictions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pastes');
    }
};
