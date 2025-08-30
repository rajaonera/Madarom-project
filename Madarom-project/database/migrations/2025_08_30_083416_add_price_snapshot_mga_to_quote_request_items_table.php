<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quote_request_items', function (Blueprint $table) {
            $table->decimal('price_snapshot_mga', 15, 2)->nullable()->after('price_snapshot');
        });
    }

    public function down(): void
    {
        Schema::table('quote_request_items', function (Blueprint $table) {
            $table->dropColumn('price_snapshot_mga');
        });
    }
};

