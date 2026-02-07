<?php

use App\Models\Car;
use App\Models\Driver;
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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->date('departure_date');
            $table->date('return_date');
            $table->foreignIdFor(Driver::class,'driver_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Car::class,'car_id')->constrained()->cascadeOnDelete();
            $table->string('start_place');
            $table->string('end_place');
            $table->string('service_type');
            $table->integer('passengers_amount');
            $table->float('departure_total');
            $table->string('departure_description');
            $table->float('return_total');
            $table->string('return_description');
            $table->float('fee_total');
            $table->float('trip_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
