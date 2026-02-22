<?php

use App\Models\Deposit;
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
            $table->foreignIdFor(Deposit::class,'deposit_id')->constrained()->cascadeOnDelete();
            $table->enum('payment_method',['Cash','Transfer']);
            $table->string('attachment_nota');
            $table->string('attachment_transfer')->nullable();
            $table->enum('status',['draft','lunas']);
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
