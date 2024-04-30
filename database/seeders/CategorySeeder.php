<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            "name" => "Cars",
            "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis tempor aliquam lorem, mattis dignissim dolor finibus sed. Fusce malesuada urna vel lacus pretium, sed feugiat metus dictum."
        ]);
    }
}
