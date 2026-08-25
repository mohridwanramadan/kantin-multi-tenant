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
        Schema::create('tenant_commissions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('tenant_id')->index();
            $table->decimal('rate', 10, 2);
            $table->date('valid_from');
            $table->date('valid_to')->nullable();
            $table->text('note')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_commissions');
    }
};
