<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categories() as $category) {
            Category::query()->firstOrCreate([
                'id',
                'name'
            ], $category);
        }
    }

    protected function categories()
    {
        return [
            [
                'id' => 1,
                'name' => 'Distributor'
            ],
            [
                'id' => 1,
                'name' => 'Customer'
            ]
        ];
    }
}
