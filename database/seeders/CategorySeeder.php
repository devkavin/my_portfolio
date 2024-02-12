<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // name, slug (name without spaces and lowercase) description, created_at, updated_at
        $categories = [
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'description' => 'Projects related to web development',
            ],
            [
                'name' => 'Mobile Development',
                'slug' => 'mobile-development',
                'description' => 'Projects related to mobile development',
            ],
            [
                'name' => 'Desktop Development',
                'slug' => 'desktop-development',
                'description' => 'Projects related to desktop development',
            ],
            [
                'name' => 'API Development',
                'slug' => 'api-development',
                'description' => 'Projects related to API development',
            ],
            [
                'name' => 'Game Development',
                'slug' => 'game-development',
                'description' => 'Projects related to game development',
            ],
            [
                'name' => 'Other',
                'slug' => 'other',
                'description' => 'Projects that do not fit in any other category',
            ],
        ];
        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
