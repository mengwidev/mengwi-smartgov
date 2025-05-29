<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DocumentCategory;
use App\Http\Resources\DocumentCategoryResource;

class DocumentCategoryController extends Controller
{
    public function index()
    {
        $documentCategory = DocumentCategory::withCount('publicInformations')->get();
        return DocumentCategoryResource::collection($documentCategory);
    }
}
