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
        Schema::table('books', function (Blueprint $table) {
            // Pertama, hapus constraint yang ada
            $table->dropForeign(['author_id']);

            // Kemudian, tambahkan ulang dengan ON DELETE CASCADE
            $table->foreign('author_id')
                ->references('id')->on('authors')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['author_id']);

            // Tambahkan kembali constraint tanpa ON DELETE CASCADE jika perlu
            $table->foreign('author_id')
                ->references('id')->on('authors');
        });
    }
};
