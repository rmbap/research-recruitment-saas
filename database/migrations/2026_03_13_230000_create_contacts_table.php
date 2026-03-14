<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {

            $table->id();

            $table->foreignId('company_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('full_name');

            $table->string('email')->nullable();

            $table->string('phone')->nullable();

            $table->date('birth_date')->nullable();

            $table->integer('age')->nullable();

            $table->string('gender')->nullable();

            $table->string('city')->nullable();

            $table->string('state')->nullable();

            $table->string('profession')->nullable();

            $table->string('bank_name')->nullable();

            $table->string('bank_segment')->nullable();

            $table->text('notes')->nullable();

            $table->string('validation_status')->default('pending');

            $table->integer('validation_score')->nullable();

            $table->json('validation_reasons_json')->nullable();

            $table->timestamp('first_seen_at')->nullable();

            $table->timestamp('last_seen_at')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
