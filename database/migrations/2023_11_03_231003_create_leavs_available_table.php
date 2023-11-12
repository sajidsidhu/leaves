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
        Schema::create('leavs_availed', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id')->nullable();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('action')->nullable();
            $table->date('leave_date')->nullable();
            $table->float('debit')->nullable();
            $table->integer('count')->nullable();
            $table->timestamps();
            $table->index(['emp_id', 'leave_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leavs_availed');
    }
};
