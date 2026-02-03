<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('account_locations', function (Blueprint $table) {
    $table->bigIncrements('location_id');
    $table->unsignedBigInteger('account_id');
    $table->string('name', 255);
    $table->enum('status', ['active', 'inactive'])->default('active');
    $table->string('county')->nullable();
    $table->string('access', 50)->default('full');
    $table->unsignedBigInteger('created_by')->nullable();
    $table->timestamp('created_date')->nullable(); // <-- Add this
    $table->timestamps();

    $table->foreign('account_id')->references('account_id')->on('accounts')->onDelete('cascade');
});

    }

    public function down(): void
    {
        Schema::dropIfExists('account_locations');
    }
};
