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
        Schema::create('contractors', function (Blueprint $table) {
            $table->id();
            $table->string('contractor_name');
            $table->string('location');
            $table->text('contractor_confirmation');
            $table->string('housing_type');
            $table->string('phone');
            $table->string('nationality');
            $table->string('work_location');
            $table->string('duration');
            $table->string('contract_number');
            $table->string('room_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contractors');
    }
};
