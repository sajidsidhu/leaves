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
        Schema::create('leaves_balance', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id');
            $table->string('name')->nullable();
            $table->string('region')->nullable();
            $table->integer('year')->default(now()->year);
            $table->integer('coff')->nullable()->default(0);
            $table->integer('el')->nullable()->default(0);
            $table->integer('lwp')->nullable()->default(0);
            $table->integer('rh')->nullable()->default(0);
            $table->integer('sl')->nullable()->default(0);
            $table->integer('wfh')->nullable()->default(0);
            $table->timestamps();
            $table->index(['emp_id', 'year']);


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves_balance');
    }
};
