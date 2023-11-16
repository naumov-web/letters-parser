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
        Schema::create('file_storage_settings', function (Blueprint $table) {
            $table->id();
            $table->string('system_name')->unique();
            $table->string('key');
            $table->string('secret');
            $table->string('region');
            $table->string('bucket');
            $table->string('url');
            $table->string('endpoint');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_storage_settings');
    }
};
