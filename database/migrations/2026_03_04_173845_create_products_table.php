<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id(); // Primary key
        $table->string('name'); // اسم المنتج
        $table->text('description')->nullable(); // وصف (يمكن أن يكون فارغاً)
        $table->boolean('is_featured')->default(false);
        $table->decimal('price', 10, 2); // السعر (10 أرقام، 2 بعد الفاصلة)
        $table->integer('stock')->default(0); // الكمية في المخزون
       // $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null'); // ربط مع التصنيفات (سننشئها لاحقاً)
        $table->string('image')->nullable(); // مسار الصورة
        $table->timestamps(); // created_at و updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
