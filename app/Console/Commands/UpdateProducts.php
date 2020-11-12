<?php

namespace App\Console\Commands;

use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class UpdateProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'updates the products in the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
	
	/**
	 * Execute the console command.
	 *
	 * @return int
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
    public function handle(Client $client)
    {
	    $response = $client->request("GET",
		    "api.tradedoubler.com/1.0/productsUnlimited.json?token=" . env("API_TOKEN"));
		
	    Product::query()->delete();
		
	    $data = json_decode($response->getBody(),true);
	    foreach($data['products'] as $entry)
	    {
		    //die( json_encode($entry));
		    $product = new Product();
		    $product->name = $entry['name'];
		    $product->description = $entry['description'];
		    $product->imageURL = $entry['productImage']['url'];
		    $product->shortDescription = $entry['shortDescription'] ?? null;
		    $product->model = $entry['model'] ?? null;
		    $product->brand = $entry['brand'] ?? null;
		    $product->ean = $entry['identifiers']['ean'] ?? null;
		    $product->sku = $entry['identifiers']['sku'] ?? null;
		    $product->save();
	    }
	    return 69;
    }
}
