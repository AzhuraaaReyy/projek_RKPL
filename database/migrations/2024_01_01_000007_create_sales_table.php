<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date('sale_date');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->decimal('total_amount', 12, 2);
            $table->enum('payment_method', ['cash', 'transfer', 'credit'])->default('cash');
            $table->enum('payment_status', ['pending', 'paid', 'cancelled'])->default('paid');
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }

    /*Alternatif Lebih Efisien:
        Di form, gunakan select2/autocomplete dropdown untuk memilih customer berdasarkan nama, lalu simpan ID-nya, bukan nama.

        Contoh Form:
        html
        Salin
        Edit
        <select name="customer_id">
        @foreach ($customers as $customer)
            <option value="{{ $customer->id }}">{{ $customer->nama }}</option>
        @endforeach
        </select>
        Dengan begitu, kamu tetap menyimpan customer_id, tapi user memilih berdasarkan customer_nama.*/
};
