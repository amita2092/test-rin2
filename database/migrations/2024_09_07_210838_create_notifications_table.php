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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
        
        // User ID of the recipient of the notification (can be nullable)
        $table->unsignedBigInteger('user_id')->nullable();
        
        // User ID of the person who created the notification
        $table->unsignedBigInteger('created_by'); // New field for the user who created the notification
        
        // Notification type (marketing, invoices, system)
        $table->enum('type', ['marketing', 'invoices', 'system']);
        
        // Short text of the notification
        $table->string('short_text');
        
        // Optional expiration time for the notification
        $table->timestamp('expiration')->nullable();
        
        // Status to indicate if the notification has been read
        $table->boolean('read')->default(false);
        
        // Foreign key for the user who will receive the notification
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        
        // Foreign key for the user who created the notification
        $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade'); // Ensure this links to the 'users' table
        
        $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
