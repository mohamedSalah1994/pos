<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'en'=> 'produtct_1_en',
                'ar'=> 'produtct_1'
            ],
            [
                'en'=> 'produtct_2_en',
                'ar'=> 'produtct_2_en'
            ],
        ];

        foreach ($products as $product) {

            Product::create([
                'category_id' => 1,
                'name' => $product,
                'description' => 'discription',
                'purchase_price' => 100,
                'sale_price' => 150,
                'stock' => 100,
            ]);

        }//end of foreach
    }
}
