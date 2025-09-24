```<?php

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
            $table->string('name'); // Nama beasiswa
            $table->text('description'); // Deskripsi beasiswa
            $table->string('image')->nullable(); // path/URL gambar
            $table->string('link')->nullable(); // link ke website pendaftaran
            $table->boolean('is_available')->default(true); // status tersedia
            $table->foreignId('organizer_id')->nullable()->constrained('organizers'); // relasi ke organizer
            $table->timestamp('starts_at')->useCurrent(); // tanggal mulai
            $table->timestamp('ends_at')->nullable(); // tanggal akhir
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