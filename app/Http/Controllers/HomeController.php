<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $menus = Menu::all();
        $categories = Menu::select('category')->distinct()->get();

        return view('menu.index',compact('menus','categories'));
    }

}
