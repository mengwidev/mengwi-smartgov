<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagePpidController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10); // default to 10

        $pages = \App\Models\PagePpid::with('category')
            ->where('is_published', true)
            ->latest()
            ->paginate($perPage);

        $data = $pages->getCollection()->map(function ($page) {
            return [
                'title'          => $page->title,
                'slug'           => $page->slug,
                'category'       => $page->category?->name,
                'content'        => $page->content,
                'featured_image' => $page->featured_image ? asset('storage/' . $page->featured_image) : null,
                'pdf_url'        => $page->pdf_path ? asset('storage/' . $page->pdf_path) : null,
                'published_at'   => $page->created_at->toDateTimeString(),
            ];
        });

        return response()->json([
            'status'       => 'success',
            'current_page' => $pages->currentPage(),
            'last_page'    => $pages->lastPage(),
            'per_page'     => $pages->perPage(),
            'total'        => $pages->total(),
            'data'         => $data,
        ]);
    }

    public function show($slug)
    {
        $page = \App\Models\PagePpid::with('category')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return response()->json([
            'status' => 'success',
            'data'   => $this->transformPage($page)
        ]);
    }

    protected function transformPage($page)
    {
        return [
            'title'          => $page->title,
            'slug'           => $page->slug,
            'category'       => $page->category?->name,
            'content'        => $page->content,
            'featured_image' => $page->featured_image ? asset('storage/' . $page->featured_image) : null,
            'pdf_url'        => $page->pdf_path ? asset('storage/' . $page->pdf_path) : null,
            'published_at'   => $page->created_at->toDateTimeString(),
        ];
    }
}
