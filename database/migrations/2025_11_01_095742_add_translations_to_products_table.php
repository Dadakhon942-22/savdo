<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Mahsulot nomlari uchun tarjimalar
            $table->string('name_uz')->nullable()->after('name');
            $table->string('name_ru')->nullable()->after('name_uz');
            $table->string('name_en')->nullable()->after('name_ru');
            
            // Tavsiflar uchun tarjimalar
            $table->text('description_uz')->nullable()->after('description');
            $table->text('description_ru')->nullable()->after('description_uz');
            $table->text('description_en')->nullable()->after('description_ru');
        });
        
        // Mavjud ma'lumotlarni to'ldirish
        DB::statement('UPDATE products SET name_uz = name, name_ru = name, name_en = name WHERE name_uz IS NULL');
        DB::statement('UPDATE products SET description_uz = description, description_ru = description, description_en = description WHERE description_uz IS NULL AND description IS NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'name_uz',
                'name_ru',
                'name_en',
                'description_uz',
                'description_ru',
                'description_en',
            ]);
        });
    }
};
