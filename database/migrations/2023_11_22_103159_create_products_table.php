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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->string('slug')->unique();
            $table->float('price');
            $table->string('link');
            $table->string('currency');
            $table->integer('stock');
            $table->enum('stock_status', ['in_stock', 'out_of_stock']);
            $table->unsignedBigInteger('brand_id')->unsigned()->nullable();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
            $table->createIndex('products_slug_index', ['slug']);

            $table->timestamps();
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
