<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemSettingSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('system_settings')->insert([
            [
                'id'             => 1,
                'title'          => 'Bobbycarterjr',
                'email'          => 'admin@admin.com',
                'system_name'    => 'Bobbycarterjr',
                'copyright_text' => '©bobbycarterjr',
                'logo'           => 'backend/images/logo/logo.png',
                'favicon'        => 'backend/images/logo/logo.png',
                'description'    => '<p>Demo Description</p>',
                'created_at'     => '2024-08-31 05:08:04',
                'updated_at'     => '2024-08-31 05:08:04',
                'deleted_at'     => null,
            ],
        ]);
    }
}
