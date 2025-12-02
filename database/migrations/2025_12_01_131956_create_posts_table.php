<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint; // <--- This line fixes the $table error
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->enum('type', ['lost', 'found']);
            $table->text('description');
            $table->string('campus');
            $table->string('category');
            $table->date('date_lost_found');
            $table->string('location_area')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['active', 'resolved'])->default('active');
            $table->integer('views')->default(0);
            $table->timestamps();

            // Indexes [cite: 3106-3111]
            $table->index('type');
            $table->index('status');
            $table->index('campus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};