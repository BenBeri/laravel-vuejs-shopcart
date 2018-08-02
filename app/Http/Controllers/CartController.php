<?php

namespace App\Http\Controllers;

use App\Http\Resources\Products;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('cart_session');
    }

    /**
     * Returns a list of products in the cart
     *
     * @param Request $request
     * @return string
     */
    public function list(Request $request) {
        $cart = $request->session()->get("cart");
        return json_encode(
            [
                "products" => $request->session()->get("cart"),
                "count" => $this->countProducts($cart)
            ]
        );
    }

    /**
     * Adds a new product to the cart or updates its quantity by increase
     *
     * @param Request $request
     * @return string
     */
    public function add(Request $request) {
        $id = $request->input("id");
        if ($id == null) {
            return json_encode(['error' => "Please include the product ID to add to cart"]);
        }

        if (!Product::where("id", "=", $id)->exists()) {
            return json_encode(['error' => "Invalid product ID"]);
        }

        $cart = $request->session()->get("cart");

        $found = false;
        if (!empty($cart)) {
            foreach ($cart as &$product) {
                if ($product["id"] == $id) {
                    $product["quantity"]++;
                    $found = true;
                    break;
                }
            }
        }

        if (!$found) {
            $cart[] = ["id" => $id, "quantity" => 1];
        }

        $request->session()->put("cart", $cart);

        return $this->returnCartWithSuccess($request);
    }

    /**
     * Removes a product from cart or updates its quantity by decrease
     * Option to remove whole quanitity by using the parameter deleteAll as true
     *
     * @param Request $request
     * @return string
     */
    public function remove(Request $request) {
        $id = $request->input("id");
        $forceAll = $request->input("deleteAll");

        $cart = $request->getSession()->get("cart");

        $found = false;
        foreach ($cart as $index => &$product) {
            if ($product["id"] == $id) {
                if ($product["quantity"] > 1 && $forceAll !== "true") {
                    $product["quantity"]--;
                }
                else {
                    unset($cart[$index]);
                }
                $found = true;
            }
        }

        if (!$found) {
            return json_encode(["error", "That product does not exist."]);
        }

        $request->session()->put("cart", $cart);
        return $this->returnCartWithSuccess($request);
    }

    public function count(Request $request) {
        return json_encode(["prodcuts_count" => count($request->session()->get("cart"))]);
    }

    /**
     * Sending a success with list of products
     *
     * @param Request $request
     * @return string
     */
    private function returnCartWithSuccess(Request $request) {
        $cart = $request->session()->get("cart");
        return json_encode(
            [
                "status" => "success",
                "products" => $cart,
                "count" => $this->countProducts($cart)
            ]
        );
    }

    private function countProducts(array $cart) {
        return count($cart);
    }
}
