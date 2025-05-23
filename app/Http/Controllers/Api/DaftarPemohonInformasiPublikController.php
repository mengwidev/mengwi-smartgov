<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DaftarPemohonInformasiPublikResource;
use App\Models\PublicInformationApplication;
use Illuminate\Http\Request;

class DaftarPemohonInformasiPublikController extends Controller
{
    public function index()
    {
        $application = PublicInformationApplication::with([
            'applicant.identifierMethod',
            'applicationMethod',
            'informationReceival',
            'applicationHistory.applicationStatus',
        ])->get();

        return response()->json([
            'success' => true,
            'data' => DaftarPemohonInformasiPublikResource::collection($application),
        ]);
    }
}
