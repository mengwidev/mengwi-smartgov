<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InformationClassification;
use App\Http\Resources\InformationClassificationResource;

class InformationClassificationController extends Controller
{
    public function index()
    {
        $classifications = InformationClassification::withCount('publicInformations')->get();
        return InformationClassificationResource::collection($classifications);
    }
}
