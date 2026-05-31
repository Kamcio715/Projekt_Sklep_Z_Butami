<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shoes', function (Blueprint $table) {
            if (Schema::hasColumn('shoes', 'nazwa')) {
                $table->renameColumn('nazwa', 'name');
            }

            if (Schema::hasColumn('shoes', 'opis')) {
                $table->renameColumn('opis', 'description');
            }

            if (Schema::hasColumn('shoes', 'cena')) {
                $table->renameColumn('cena', 'price');
            }

            if (Schema::hasColumn('shoes', 'marka')) {
                $table->renameColumn('marka', 'brand');
            }

            if (Schema::hasColumn('shoes', 'kategoria')) {
                $table->renameColumn('kategoria', 'category');
            }

            if (Schema::hasColumn('shoes', 'rodzaj')) {
                $table->renameColumn('rodzaj', 'type');
            }

            if (Schema::hasColumn('shoes', 'kolor')) {
                $table->renameColumn('kolor', 'color');
            }

            if (Schema::hasColumn('shoes', 'rozmiar')) {
                $table->renameColumn('rozmiar', 'size');
            }

            if (Schema::hasColumn('shoes', 'zdjecie')) {
                $table->renameColumn('zdjecie', 'image');
            }
        });
    }

    public function down(): void
    {
        Schema::table('shoes', function (Blueprint $table) {
            if (Schema::hasColumn('shoes', 'name')) {
                $table->renameColumn('name', 'nazwa');
            }

            if (Schema::hasColumn('shoes', 'description')) {
                $table->renameColumn('description', 'opis');
            }

            if (Schema::hasColumn('shoes', 'price')) {
                $table->renameColumn('price', 'cena');
            }

            if (Schema::hasColumn('shoes', 'brand')) {
                $table->renameColumn('brand', 'marka');
            }

            if (Schema::hasColumn('shoes', 'category')) {
                $table->renameColumn('category', 'kategoria');
            }

            if (Schema::hasColumn('shoes', 'type')) {
                $table->renameColumn('type', 'rodzaj');
            }

            if (Schema::hasColumn('shoes', 'color')) {
                $table->renameColumn('color', 'kolor');
            }

            if (Schema::hasColumn('shoes', 'size')) {
                $table->renameColumn('size', 'rozmiar');
            }

            if (Schema::hasColumn('shoes', 'image')) {
                $table->renameColumn('image', 'zdjecie');
            }
        });
    }
};