<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MenuController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->except(['index','show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $menus = Menu::all();
        $categories = Menu::select('category')->distinct()->get();

        return view('menu.index',compact('menus','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('images')) {
            $destinationPath = 'images/';
            $menuImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $menuImage);
            $input['path'] = "$menuImage";
        }

        Menu::create($input);

        return redirect()->route('menu.index')->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Menu  $menu
     * @return Application|Factory|View
     */
    public function show(Menu $menu)
    {
        return view('menu.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Menu  $menu
     * @return Application|Factory|View
     */
    public function edit(Menu $menu)
    {
        return view('menu.edit',compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  Menu $menu
     * @return RedirectResponse
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('images')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['path'] = "$profileImage";
        }else{
            unset($input['path']);
        }

        $menu->update($input);

        return redirect()->route('menu.index')
            ->with('success','Menu updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Menu  $menu
     * @return RedirectResponse
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menu.index')->with('success','Menu deleted successfully');
    }
}
