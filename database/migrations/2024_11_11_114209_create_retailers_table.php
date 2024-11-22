<?php

use App\Models\DdHouse;
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
        Schema::create('retailers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DdHouse::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Rso::class);
            $table->foreignIdFor(User::class, 'zm');
            $table->foreignIdFor(User::class, 'manager');
            $table->foreignIdFor(User::class, 'supervisor');
            $table->string('code');
            $table->string('name');
            $table->string('number');
            $table->string('type')->nullable();
            $table->string('enabled')->nullable();
            $table->string('sso')->nullable();
            $table->string('service_point')->nullable();
            $table->string('category')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('division')->nullable();
            $table->string('district')->nullable();
            $table->string('thana')->nullable();
            $table->string('address')->nullable();
            $table->date('dob')->nullable();
            $table->string('nid')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->longText('description')->nullable();
            $table->string('remarks')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamp('disabled_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retailers');
    }
};
