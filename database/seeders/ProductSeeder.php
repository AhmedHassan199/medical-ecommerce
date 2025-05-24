<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = Category::all();

        Product::factory()->count(20)->create([
            'category_id' => fn() => $categories->random()->id
        ]);

        $this->command->info('Products seeded successfully!');
    }
}
