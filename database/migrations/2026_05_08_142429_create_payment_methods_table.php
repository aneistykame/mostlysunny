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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id('payment_id');
            $table->string('name');
            $table->timestamps();
        });

        // Vložíme základné možnosti
        DB::table('payment_methods')->insert([
            ['name' => 'Platba kartou'],
            ['name' => 'Apple Pay / Google Pay'],
            ['name' => 'Dobierka'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
