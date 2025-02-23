<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MobileMenu;
use Illuminate\Http\Request;
use App\Http\Resources\MobileMenuResource;

class MobileMenuController extends Controller
{
    public function index()
    {
        // get all data
        $menus = MobileMenu::all();

        return new MobileMenuResource(true, 'Mobile App Menus', $menus);
    }
}
