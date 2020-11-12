<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
	    $faker = \Faker\Factory::create();
	    for($i = 0;$i < 10;$i++)
	    {
	    	$product = new Product();
	    	$product->brand = $faker->name;
	    	$product->name = $faker->name;
	    	$product->description = $faker->paragraph;
	    	$product->ean = $faker->creditCardNumber;
	    	$product->sku = $faker->creditCardNumber;
	    	$product->imageURL = $faker->url;
	    	$product->model = $faker->word;
	    	$product->shortDescription = $faker->paragraph;
	    	$product->save();
	    }
    }
}
