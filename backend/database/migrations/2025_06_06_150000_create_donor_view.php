<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {

        DB::statement('DROP VIEW IF EXISTS donor_view');

        DB::statement('
            CREATE VIEW donor_view
            AS
            SELECT

            u.id, u.name, u.email, u.phone,

            di.address, di.blood_group,
            di.is_available, di.last_donation_date,
            di.profession, di.religion,
            di.age, di.medical_conditions

            FROM users u, donor_information di

            WHERE u.id = di.user_id AND u.role = "donor" AND u.is_active = 1
            ORDER BY u.name ASC
        ');
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS donor_view");
    }
};
