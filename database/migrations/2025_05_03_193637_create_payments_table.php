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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('transaction_id')->nullable();
            $table->integer('student_id')->nullable();
            $table->decimal('money', 15, 2)->nullable();
            $table->string('note', 100)->nullable();
            $table->string('vnp_response_code', 255)->nullable();
            $table->string('code_vnpay', 255)->nullable()->comment('Mã giao dịch vnpay');
            $table->string('code_bank', 255)->nullable()->comment('Mã ngân hàng');
            $table->dateTime('time')->nullable()->comment('Thời gian giao dịch');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
