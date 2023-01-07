<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(5)
            ->has(
                Category::factory()
                ->count(10)
                ->state(fn (array $attributes, Category $category) => ['parent_id' => $category->id, 'level' => 1])
                ->has(
                    Product::factory()->count(10)
                    ->state(fn (array $attributes, Category $category) => ['category_id' => $category->id]),
                    'products'
                ),
                'children'
            )
            ->state(fn (array $attributes) => ['parent_id' => null, 'level' => 0])
            ->create();
    }
}
