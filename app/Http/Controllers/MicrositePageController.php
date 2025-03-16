<?php

namespace App\Http\Controllers;

use App\Models\MicrositePage;

class MicrositePageController extends Controller
{
    public function show($slug)
    {
        $micrositePage = MicrositePage::with('link')->where('slug', $slug)->firstOrFail();

        return view('microsite_pages.show', [
            'micrositePage' => $micrositePage,
        ]);
    }
}
