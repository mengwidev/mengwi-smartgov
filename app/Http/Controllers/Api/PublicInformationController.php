<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PublicInformation;
use App\Http\Resources\InformasiPublikResource;

class PublicInformationController extends Controller
{
    public function index()
    {
        $documents = PublicInformation::with(['informationClassification', 'documentCategory'])->latest()->paginate(10);
        return InformasiPublikResource::collection($documents);
    }

    public function store(Request $request)
    {
        return response()->json([
            'message' => 'This operation is not permitted through the public API.',
            403
        ]);
    }

    public function update(Request $request, $id)
    {
        return response()->json([
            'message' => 'This operation is not permitted through the public API.',
            403
        ]);
    }

    public function show($id)
    {
        return response()->json([
            'message' => 'This operation is not permitted through the public API.',
            403
        ]);
    }

    public function destroy($id)
    {
        return response()->json([
            'message' => 'This operation is not permitted through the public API.',
            403
        ]);
    }
}
