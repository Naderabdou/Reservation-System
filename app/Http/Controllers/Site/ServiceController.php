<?php

namespace App\Http\Controllers\Site;


use App\Models\Service;

use App\Services\OrderService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ServiceStoreRequest;


class ServiceController extends Controller
{




    public function index()
    {
        $services = Service::where('is_available', 1)->latest()->get();
        return view('site.services.index', compact('services'));
    }




    public function show($slug)
    {
        $service = Service::where('slug', $slug)->where('is_available', 1)->firstOrFail();
        $services = Service::where('is_available', 1)->where('id', '!=', $service->id)->latest()->take(3)->get();
        return view('site.services.show', compact('service', 'services'));
    }

   
}
