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
        Schema::table('pricing_plans', function (Blueprint $table) {
            $table->decimal('original_monthly_price', 10, 2)->nullable()->after('monthly_price');
            $table->decimal('original_annual_price', 10, 2)->nullable()->after('annual_price');
            $table->boolean('has_promotion')->default(false)->after('is_custom_plan');
            $table->string('promotion_text')->nullable()->after('has_promotion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pricing_plans', function (Blueprint $table) {
            $table->dropColumn(['original_monthly_price', 'original_annual_price', 'has_promotion', 'promotion_text']);
        });
    }
};
