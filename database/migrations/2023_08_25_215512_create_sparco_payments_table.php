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
        Schema::create('sparco_payments', function (Blueprint $table) {
            $table->id();
            $table->string('merchantReference');
            $table->string('reference');
            $table->integer('amount');
            $table->string('currency');
            $table->integer('feeAmount');
            $table->decimal('feePercentage', 5, 2);
            $table->integer('transactionAmount');
            $table->string('customerMobileWallet');
            $table->string('customerFirstName');
            $table->string('customerLastName');
            $table->text('message');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sparco_payments');
    }
};
