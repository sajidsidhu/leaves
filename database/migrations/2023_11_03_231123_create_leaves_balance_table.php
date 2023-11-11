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
            $table->integer('user_id');
            $table->integer('month');
            $table->integer('year');
            $table->integer('coff')->default(0);
            $table->integer('el')->default(0);
            $table->integer('lwp')->default(0);
            $table->integer('rh')->default(0);
            $table->integer('sl')->default(0);
            $table->integer('wfh')->default(0);
            $table->timestamps();
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
