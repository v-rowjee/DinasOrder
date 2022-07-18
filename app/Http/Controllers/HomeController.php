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

        // TO ORDER MENU BY SPECIFIC CATEGORY
        $queryOrder = "CASE WHEN category = 'starter' THEN 1";
        $queryOrder .= " WHEN category = 'pasta' THEN 2";
        $queryOrder .= " WHEN category = 'pizza' THEN 3";
        $queryOrder .= " WHEN category = 'drink' THEN 4";
        $queryOrder .= " ELSE 5 END";

        $categories = Menu::select('category')->distinct()->orderByRaw($queryOrder)->get();

        return view('menu.index',compact('menus','categories'));
    }

}
