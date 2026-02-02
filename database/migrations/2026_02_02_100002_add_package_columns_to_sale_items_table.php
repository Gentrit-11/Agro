<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sale_items', function (Blueprint $table) {
            $table->integer('package_quantity')->default(0)->after('quantity');
            $table->decimal('base_per_package', 10, 3)->default(0)->after('package_quantity');
        });
    }

    public function down(): void
    {
        Schema::table('sale_items', function (Blueprint $table) {
            $table->dropColumn(['package_quantity', 'base_per_package']);
        });
    }
};
