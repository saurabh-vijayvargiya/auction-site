<?php

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
        $data = ['Cars', 'Laptops', 'Mobiles', 'Real Estate', 'Kitchenware', 'Household', 'Gym Equipments'];
		foreach ($data as $index => $category) {
			DB::table('categories')->insert([
			    'category' => $category
			]);
		}
    }
}
