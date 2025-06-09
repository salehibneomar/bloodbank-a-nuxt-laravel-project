<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("DROP VIEW IF EXISTS admin_dashboard_view");

        DB::statement('
            CREATE VIEW admin_dashboard_view
            AS
            SELECT
                COUNT(*) AS total_users,
                SUM(is_active = 1) AS active_users,
                SUM(is_active = 0) AS inactive_users
            FROM users
        ');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS admin_dashboard_view");
    }
};
