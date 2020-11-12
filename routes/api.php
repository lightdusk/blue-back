<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("products/{page}/{limit}", [\App\Http\Controllers\ProductController::class,'getProductsPaginated']);
Route::get("products/count", fn() => json_encode(['count' => DB::table('products')->count()]));

Route::get('test', function() {
	$client = new \GuzzleHttp\Client();
	$response = $client->request("GET",
		"api.tradedoubler.com/1.0/products.json?token=" . env("API_TOKEN"));
	
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
});
