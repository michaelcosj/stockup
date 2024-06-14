<?php

use App\Models\User;
use App\Models\StockList;
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
        Schema::create('list_members', function (Blueprint $table) {
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(StockList::class);
            $table->enum('role', ['ADMIN', 'UPDATE', 'VIEW']);
            $table->timestamps();

            $table->primary(['user_id', 'stock_list_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_members');
    }
};
