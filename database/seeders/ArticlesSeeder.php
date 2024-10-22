<?php

namespace Database\Seeders;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::insert([
            [
                'course_id' => 1, // Ensure this ID exists in the courses table
                'image_url' => 'backend/article_image/1.jpg',
                'title' => 'Article Title 1',
                'description' => 'This is the description for article 1.',
                'mark' => 15,
                'file_url' => 'backend/audio/audio.mp3',
                'audio_time' => 284.026485,
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'course_id' => 2, // Ensure this ID exists in the courses table
                'image_url' => 'backend/article_image/2.jpg',
                'title' => 'Article Title 2',
                'description' => 'This is the description for article 2.',
                'mark' => 20,
                'file_url' => null,
                'audio_time' => null,
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'course_id' => 1, // Ensure this ID exists in the courses table
                'image_url' => 'backend/article_image/3.jpg',
                'title' => 'Article Title 3',
                'description' => 'This is the description for article 3.',
                'mark' => 10,
                'file_url' => 'backend/audio/audio2.mp3',
                'audio_time' => 25.211814,
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
