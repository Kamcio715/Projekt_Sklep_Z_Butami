<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('id_klienta', 'user_id');
            $table->renameColumn('imie_klienta', 'customer_name');
            $table->renameColumn('email_klienta', 'customer_email');
            $table->renameColumn('telefon_klienta', 'customer_phone');
            $table->renameColumn('adres', 'address');
            $table->renameColumn('kwota', 'total_amount');
            $table->renameColumn('przedmioty', 'items');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('user_id', 'id_klienta');
            $table->renameColumn('customer_name', 'imie_klienta');
            $table->renameColumn('customer_email', 'email_klienta');
            $table->renameColumn('customer_phone', 'telefon_klienta');
            $table->renameColumn('address', 'adres');
            $table->renameColumn('total_amount', 'kwota');
            $table->renameColumn('items', 'przedmioty');
        });
    }
};