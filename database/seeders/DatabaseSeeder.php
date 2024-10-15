<?php

namespace Database\Seeders;

use Database\Seeders\CourseSeeder;
use Database\Seeders\CourseTypeSeeder;
use Database\Seeders\DynamicPageSeeder;
use Database\Seeders\SubscriptionSeeder;
use Database\Seeders\SystemSettingSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $this->call([
            UserSeeder::class,
            SubscriptionSeeder::class,
            SystemSettingSeeder::class,
            DynamicPageSeeder::class,
            CourseTypeSeeder::class,
            CourseSeeder::class,
            SurvayQuestionSeeder::class,
            OptionSeeder::class,
            ModuleSeeder::class,
        ]);
    }
}
