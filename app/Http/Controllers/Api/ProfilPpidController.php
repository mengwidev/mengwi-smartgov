<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProfilPpidResource;
use App\Http\Controllers\Controller;
use App\Models\ProfilPpid;
use Illuminate\Http\Request;

class ProfilPpidController extends Controller
{
    public function index()
    {
        $officers = ProfilPpid::with([
            'role',
            'employee.contacts',
            'employee.employeeLevel',
            'employee.employmentUnit'
        ])->get();

        return ProfilPpidResource::collection($officers);
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
