<?php

namespace App\Http\Controllers;

use App\Http\Resources\Products;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    /**
     * Lists products based on the given skip
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function list(Request $request) {
        $start = 0;
        if ($request->get("start") != null) {
            $start = $request->get("start");
        }
       // return Products::collection(Product::skip($start)->take(6)->leftJoin("product_thumbnail", "products.id", "=", "product_thumbnail.id")->get());
        return Products::collection((Product::with('thumbnails')->skip($start)->take(6)->get()));
    }

    public function add(Request $request) {


        $name = $request->input("title");
        $desc = $request->input("description");
        $price = $request->input("price");
        $thumbnail_id = $request->input("thumbnail_id");

        // todo validate.... the input

        Product::insert(
          ["title" => $name, "description" => $desc, "price" => $price, "thumbnail_id" => $thumbnail_id]
        );
    }
}
