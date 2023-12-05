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
        Schema::table('transaction_items', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->unsignedBigInteger('inventory_item_id');
            $table->foreign('inventory_item_id')->references('id')->on('inventory_items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_items', function (Blueprint $table) {
            $table->dropForeign('transaction_items_product_id_foreign');
            $table->dropColumn('product_id');
            $table->dropForeign('transaction_items_inventory_item_id_foreign');
            $table->dropColumn('inventory_item_id');
        });
    }
};
