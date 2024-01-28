<?php

use App\Models\Fruit;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Fruit::class);
            $table->unsignedSmallInteger('quantity');
            $table->unsignedDecimal('value', 6, 2);
            $table->enum('discount', [0, 5, 10, 15, 20, 25]);
            $table->timestamp('sold_at');
            $table->timestamps();

            $foreignUser  = $table->foreignId('user_id');
            $foreignFruit = $table->foreignId('fruit_id');

            $foreignUser->constrained();
            $foreignFruit->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
