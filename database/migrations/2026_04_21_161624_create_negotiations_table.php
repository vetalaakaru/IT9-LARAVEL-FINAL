<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lending_negotiations', function (Blueprint $table) {
            $table->id();
            
            // Link to the item being lent
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            
            // Participants
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');

            // The Negotiable Terms
            $table->decimal('proposed_price', 10, 2);
            $table->integer('duration_days')->default(7); // How long they keep the item
            
            // Status Management
            // 'pending' = still chatting, 'accepted' = finalized, 'rejected' = cancelled
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lending_negotiations');
    }
};