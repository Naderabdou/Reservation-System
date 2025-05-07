<?php

namespace App\Http\Controllers\API;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServicesResource;
use App\Http\Controllers\API\Traits\ApiResponseTrait;

class ServiceController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $services = Service::all();
        if ($services->isEmpty()) {
            return $this->notFoundResponse();
        }

        return $this->ApiResponse(ServicesResource::collection($services));
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $services = Service::whereAny(['name_ar','name_en'],'LIKE','%' . $search . '%')->get();

        if ($services->isEmpty()) {
            return $this->notFoundResponse();
        }

        return $this->ApiResponse(ServicesResource::collection($services));
    }
}
