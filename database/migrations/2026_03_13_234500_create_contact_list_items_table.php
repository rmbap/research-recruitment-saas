<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_list_items', function (Blueprint $table) {

            $table->id();

            $table->foreignId('contact_list_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('contact_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('status')->default('active');

            $table->timestamp('added_at')->nullable();

            $table->timestamp('removed_at')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->unique(['contact_list_id','contact_id']);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_list_items');
    }
};
