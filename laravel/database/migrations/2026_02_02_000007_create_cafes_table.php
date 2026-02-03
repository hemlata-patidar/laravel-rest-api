<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cafes', function (Blueprint $table) {
    $table->bigIncrements('cafe_id');
    $table->unsignedBigInteger('account_id');
    $table->unsignedBigInteger('location_id');
    $table->string('name', 255);
    $table->enum('status', ['active', 'inactive'])->default('active');
    $table->string('menu_type', 50)->nullable();
    $table->integer('position')->default(0);
    $table->boolean('is_default')->default(false);
    $table->string('cost_center', 50)->nullable();

    // Cafe configuration flags
    $table->boolean('enable_time_temp_log')->default(false);
    $table->boolean('enable_eni_facts')->default(false);
    $table->boolean('enable_cafe_cloning')->default(false);
    $table->boolean('enable_station_price')->default(false);
    $table->boolean('enable_station_note')->default(false);
    $table->boolean('enable_cust_footer_logo')->default(false);
    $table->string('cust_footer_logo', 255)->nullable();

    $table->timestamps();

    $table->foreign('account_id')->references('account_id')->on('accounts')->onDelete('cascade');
    $table->foreign('location_id')->references('location_id')->on('account_locations')->onDelete('cascade');
});

    }

    public function down(): void
    {
        Schema::dropIfExists('cafes');
    }
};
