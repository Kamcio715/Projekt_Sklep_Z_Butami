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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_klienta')->nullable()->constrained('users')->nullOnDelete();
            $table->string('imie_klienta');
            $table->string('email_klienta');
            $table->string('telefon_klienta')->nullable();
            $table->string('adres');
            $table->decimal('kwota', 10, 2);
            $table->json('przedmioty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
