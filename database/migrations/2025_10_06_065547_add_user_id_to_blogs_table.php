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
        Schema::table('blogs', function (Blueprint $table) {
            if (!Schema::hasColumn('blogs', 'user_id')) {
                $table->foreignId('user_id')->constrained()->after('id')->onDelete('cascade')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            if (Schema::hasColumn('blogs', 'user_id')) {
            try {
                $table->dropForeign(['user_id']);
            } catch (\Exception $e) {
                // foreign key may not exist, ignore
            }

            $table->dropColumn('user_id');
        }
        });
    }
};
