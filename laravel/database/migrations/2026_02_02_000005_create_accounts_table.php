<?php 
  use Illuminate\Database\Migrations\Migration;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Support\Facades\Schema;

  return new class extends Migration {
    public function up(): void
    {
      Schema::create('accounts', function (Blueprint $table) {
        $table->bigIncrements('account_id');
        $table->string('name', 255)->index();
        $table->enum('status', ['active', 'inactive'])->default('active');
        $table->boolean('eni_enabled')->default(false);
        $table->string('account_type', 50)->nullable();
        $table->boolean('enable_time_temp_log')->default(false);
        $table->boolean('enable_eni_facts')->default(false);
        $table->boolean('enable_cafe_cloning')->default(false);
        $table->boolean('enable_station_price')->default(false);
        $table->boolean('enable_station_note')->default(false);
        $table->boolean('enable_cust_footer_logo')->default(false);
        $table->string('cust_footer_logo')->nullable();
        $table->string('access', 50)->nullable();

        $table->timestamps();
      });
    }

    public function down(): void
    {
      Schema::dropIfExists('accounts');
    }
  };

?>