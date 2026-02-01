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
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('purchase_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();

            // baza (kg / copë / litër)
            $table->decimal('quantity_base', 10, 3);

            // kuti / paketim
            $table->integer('package_quantity')->nullable();
            $table->decimal('base_per_package', 10, 3)->nullable();

            // çmimi
            $table->decimal('price_per_base_unit', 10, 2);
            $table->decimal('total', 12, 2);

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};
