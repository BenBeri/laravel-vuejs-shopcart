<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 02/08/2018
 * Time: 11:29
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request) {
        return view("index");
    }
}