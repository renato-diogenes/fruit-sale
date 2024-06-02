<?php

use App\Enums\Discount;
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

            $foreignUser = $table->foreignIdFor(User::class);
            $foreignFruit = $table->foreignIdFor(Fruit::class);

            $table->unsignedSmallInteger('quantity');
            $table->unsignedDecimal('value', 6, 2);
            $table->enum('discount', Discount::toArray());
            $table->timestamp('sold_at');
            $table->timestamps();

            $foreignUser->constrained();
            $foreignFruit->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
