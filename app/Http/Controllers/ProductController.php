<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getProductsPaginated(int $page, int $limit)
    {
        return DB::table("products")->skip($page*$limit)->take($limit)->get();
    }
}
