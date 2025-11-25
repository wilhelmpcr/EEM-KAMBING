<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('multipleuploads', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('ref_table', 100); // kolom tambahan langsung
            $table->unsignedBigInteger('ref_id'); // kolom tambahan langsung
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('multipleuploads');
    }
};
