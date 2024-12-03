<?php

use App\Models\DdHouse;
use App\Models\User;
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
        Schema::create('liftings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor( DdHouse::class);  // Distribution House ID
            $table->foreignIdFor( User::class);     // User ID
            $table->json('products');              // Products array
            $table->integer('itopup');             // ITOP value
            $table->integer('deposit');       // Bank Deposit
            $table->string('attempt')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liftings');
    }
};
