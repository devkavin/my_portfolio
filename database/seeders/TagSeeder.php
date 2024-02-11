<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // name, slug (name without spaces and lowercase)
        $tags = [
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
            ],
            [
                'name' => 'Vue.js',
                'slug' => 'vuejs',
            ],
            [
                'name' => 'React',
                'slug' => 'react',
            ],
            [
                'name' => 'PHP',
                'slug' => 'php',
            ],
            [
                'name' => 'JavaScript',
                'slug' => 'javascript',
            ],
            [
                'name' => 'HTML',
                'slug' => 'html',
            ],
            [
                'name' => 'Flutter',
                'slug' => 'flutter',
            ],
            [
                'name' => 'Dart',
                'slug' => 'dart',
            ],
            [
                'name' => 'CMS',
                'slug' => 'cms',
            ],
            [
                'name' => 'Frontend',
                'slug' => 'frontend',
            ],
            [
                'name' => 'Backend',
                'slug' => 'backend',
            ],
            [
                'name' => 'Fullstack',
                'slug' => 'fullstack',
            ],
        ];

        foreach ($tags as $tag) {
            \App\Models\Tag::create($tag);
        }
    }
}
