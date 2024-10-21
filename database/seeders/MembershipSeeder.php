<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembershipSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        //! Truncate the memberships table before seeding
        DB::table('memberships')->truncate();

        //! Insert memberships data
        DB::table('memberships')->insert([
            [
                'id'              => 1,
                'user_id'         => 3,
                'subscription_id' => 2,
                'start_date'      => '2024-10-21 11:16:21',
                'end_date'        => '2024-10-21 11:16:21',
                'created_at'      => '2024-10-21 05:15:44',
                'updated_at'      => '2024-10-21 05:15:44',
                'deleted_at'      => null,
            ],
            [
                'id'              => 2,
                'user_id'         => 2,
                'subscription_id' => 1,
                'start_date'      => '2024-10-21 11:18:24',
                'end_date'        => '2024-10-21 11:18:24',
                'created_at'      => '2024-10-21 05:25:44',
                'updated_at'      => '2024-10-21 05:25:44',
                'deleted_at'      => null,
            ],
        ]);
    }
}
