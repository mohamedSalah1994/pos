<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $categories = [
            [
                'en'=> 'cat_1_en',
                'ar'=> 'cat_1'
            ],
            [
                'en'=> 'cat_2_en',
                'ar'=> 'cat_2'
            ],
            [
                'en'=> 'cat_3_en',
                'ar'=> 'cat_3'
            ],
        ];

        foreach ($categories as $category) {

            Category::create([
                'name' => $category
            ]);

        }//end of foreach
    }
}
