<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_events', function (Blueprint $table) {

            $table->id();

            $table->foreignId('company_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('contact_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('organization_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('contact_list_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('event_type');

            $table->timestamp('event_date')->nullable();

            $table->text('notes')->nullable();

            $table->json('metadata_json')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_events');
    }
};
