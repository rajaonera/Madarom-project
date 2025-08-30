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
            $table->string('reference')
                ->unique()
                ->nullable()
                ->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quote', function (Blueprint $table) {
            $table->dropColumn('reference');
        });
    }
<<<<<<< Updated upstream:Madarom-project/database/migrations/2025_08_01_080725_add_reference_to_quote_table.php
};
=======
};
>>>>>>> Stashed changes:database/migrations/2025_08_01_080725_add_reference_to_quote_table.php
