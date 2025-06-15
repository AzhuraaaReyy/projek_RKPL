<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bahan_baku_id')->constrained('bahan_bakus');
            $table->enum('movement_type', ['in', 'out']);
            $table->decimal('quantity', 10, 2);
            $table->decimal('remaining_stock', 10, 2);
            $table->enum('reference_type', ['purchase', 'production', 'adjustment', 'waste']);
           
            $table->text('notes')->nullable();
            $table->date('movement_date');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void {
        Schema::dropIfExists('stock_movements');
    }
};
