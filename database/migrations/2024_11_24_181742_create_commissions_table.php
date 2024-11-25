<?php

use App\Models\DdHouse;
use App\Models\Retailer;
use App\Models\Rso;
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
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor( DdHouse::class);
            $table->foreignIdFor( User::class, 'zm');
            $table->foreignIdFor( User::class, 'manager');
            $table->foreignIdFor( User::class, 'supervisor');
            $table->foreignIdFor( Rso::class);
            $table->foreignIdFor( Retailer::class);
            $table->string('for');
            $table->string('type');
            $table->string('name');
            $table->date('month');
            $table->string('amount');
            $table->date('receive_date');
            $table->string('description');
            $table->string('remarks');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};
