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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string("Region")->nullable();
            $table->string("Country")->nullable();
            $table->string("ItemType")->nullable();
            $table->string("SalesChannel")->nullable();
            $table->string("OrderPriority")->nullable();
            $table->string("OrderDate")->nullable();
            $table->string("OrderID")->nullable();
            $table->string("ShipDate")->nullable();
            $table->string("UnitsSold")->nullable();
            $table->string("UnitPrice")->nullable();
            $table->string("UnitCost")->nullable();
            $table->string("TotalRevenue")->nullable();
            $table->string("TotalCost")->nullable();
            $table->string("TotalProfit")->nullable();
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
