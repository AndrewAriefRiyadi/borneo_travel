<?php

use App\Models\Car;
use App\Models\Trip;
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
        Schema::create('costs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Trip::class,'trip_id')->constrained()->cascadeOnDelete();
            $table->float('bbm_total');
            $table->string('bbm_attachment');
            $table->float('wash_total');
            $table->float('parking_total');
            $table->string('parking_attachment');
            $table->float('repair_total');
            $table->string('repair_attachment');
            $table->foreignIdFor(Car::class,'car_id')->constrained()->cascadeOnDelete();
            $table->float('cost_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costs');
    }
};
