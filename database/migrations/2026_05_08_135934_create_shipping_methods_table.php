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
    Schema::create('shipping_methods', function (Blueprint $table) {
        $table->id('shipping_id');
        $table->string('name');
        $table->decimal('price', 8, 2);
        $table->timestamps();
    });

    DB::table('shipping_methods')->insert([
        ['name' => 'Kuriér na adresu', 'price' => 4.99],
        ['name' => 'Zásielkovňa', 'price' => 2.99],
        ['name' => 'Osobný odber', 'price' => 0.00],
    ]);
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_methods');
    }
};
