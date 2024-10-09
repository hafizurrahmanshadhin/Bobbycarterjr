<?php

namespace Database\Seeders;

use Database\Seeders\DynamicPageSeeder;
use Database\Seeders\SystemSettingSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $this->call([
            UserSeeder::class,
            SystemSettingSeeder::class,
            DynamicPageSeeder::class,
        ]);
    }
}
