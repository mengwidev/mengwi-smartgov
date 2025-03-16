<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MobileMenuResource;
use App\Models\MobileMenu;
use Illuminate\Http\Request;

class MobileMenuController extends Controller
{
    // 👁️ GET: Fetch all menus
    public function index()
    {
        $menus = MobileMenu::all();

        return new MobileMenuResource(true, 'Mobile App Menus', $menus);
    }

    // ➕ POST: Create a new menu
    public function store(Request $request)
    {
        $menu = MobileMenu::create($request->all());

        return new MobileMenuResource(true, 'Menu created successfully', $menu);
    }

    // 🔃 PUT/PATCH: Update an existing menu
    public function update(Request $request, $id)
    {
        $menu = MobileMenu::find($id);

        if (! $menu) {
            return new MobileMenuResource(false, 'Menu not found', null);
        }

        $menu->update($request->all());

        return new MobileMenuResource(true, 'Menu updated successfully', $menu);
    }

    // 🗑️ DELETE: Remove a menu
    public function destroy($id)
    {
        $menu = MobileMenu::find($id);

        if (! $menu) {
            return new MobileMenuResource(false, 'Menu not found', null);
        }

        $menu->delete();

        return new MobileMenuResource(true, 'Menu deleted successfully', null);
    }
}
