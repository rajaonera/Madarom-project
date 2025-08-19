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
        Schema::table('quote', function (Blueprint $table) {
            $table->integer('day')
                ->nullable(false)
                ->default(0);

            $table->integer('hours')
                ->nullable(false)
                ->default(0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quote', function (Blueprint $table) {
            $table->dropColumn('day');
            $table->dropColumn('hours');
        });
    }
};
