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
        Schema::create('patients', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('name');
            $table->foreign('doctor_id')
                ->references('id')
                ->on('doctors')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->date('dob');
            $table->string('gender', 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
