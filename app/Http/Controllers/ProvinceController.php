<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\Province;

class ProvinceController extends Controller
{
    public function getProvinces(): JsonResponse
    {
        $provinces = Province::all(['id', 'name', 'gso_id']);
        return response()->json($provinces);
    }
}
