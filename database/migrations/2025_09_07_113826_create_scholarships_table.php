<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('category', ['d1', 'd2', 'd3', 'd4', 's1', 's2', 's3', 'sma/smk']);
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->boolean('is_available')->default(true);
            $table->foreignId('organizer_id')->nullable()->constrained('organizers');
            $table->timestamp('starts_at')->useCurrent();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};