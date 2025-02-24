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
        Schema::create('transaction_detail', function (Blueprint $table) {
            $table->integer("id")->autoIncrement();
            $table->integer("transaction_id");
            $table->integer("barang_id");
            $table->integer("quantity");
            $table->integer("total");
            $table->timestamps();

            $table->foreign("transaction_id")->references("id")->on("transaction");
            $table->foreign("barang_id")->references("id")->on("barang");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_detail');
    }
};
