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
        Schema::create('applications', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary()->unique();
            $table->string('key');
            $table->string('secret');
            $table->unsignedInteger('ping_interval')->default(60);
            $table->json('allowed_origins');
            $table->unsignedInteger('max_message_size')->default(10_000);
            $table->json('options');
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['id', 'key', 'secret']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
