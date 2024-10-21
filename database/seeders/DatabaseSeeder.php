<?php

namespace Database\Seeders;

use Database\Seeders\ArticlesSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\CourseTypeSeeder;
use Database\Seeders\DailyAffirmationsSeeder;
use Database\Seeders\DynamicPageSeeder;
use Database\Seeders\MembershipSeeder;
use Database\Seeders\ModuleSeeder;
use Database\Seeders\OptionSeeder;
use Database\Seeders\SubscriptionSeeder;
use Database\Seeders\SurvayQuestionSeeder;
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
            ArticlesSeeder::class,
            DailyAffirmationsSeeder::class,
            MembershipSeeder::class,
        ]);
    }
}
