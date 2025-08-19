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
            $table->unsignedBigInteger('quote_request_id')->nullable()->after('id');
            $table->foreign('quote_request_id')
                ->references('id')
                ->on('quote_requests')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quote', function (Blueprint $table) {
            $table->dropForeign('quote_request_id');
            $table->dropColumn('quote_request_id');
        });
    }
};
