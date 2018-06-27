<?php

use Illuminate\Database\Seeder;
use \App\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();
        $product->name = "Emperor-In The Nightside Eclipse";
        $product->save();

        $product = new Product();
        $product->name = "Megadeth-Rust In Peace";
        $product->save();

        $product = new Product();
        $product->name = "Bathory- Twilight of the gods";
        $product->save();

        $product = new Product();
        $product->name = "Dissection- Storm of the lights bane";
        $product->save();
    }
}
