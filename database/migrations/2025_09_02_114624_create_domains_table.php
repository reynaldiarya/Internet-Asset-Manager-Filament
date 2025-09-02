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
        Schema::create('domains', function (Blueprint $table) {
            $table->uuid()->primary()->unique();
            $table->string('name');
            $table->foreignUuid('registrar_id')->references('uuid')->on('registrars')->onDelete('restrict');
            $table->enum('hosting', ['-', 'Shared Hosting', 'Cloud Hosting', 'WordPress Hosting', 'Unlimited Hosting', 'VPS', 'Dedicated Server'])->default('-');
            $table->date('registration_date');
            $table->date('expiry_date');
            $table->decimal('renewal_cost', 10, 2);
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};
