<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['userServices']]);
    }

    /**
     * @return Application|Factory|View
     */
    public function list()
    {
        $services = Service::all();

        return view('welcome', ['services' => $services]);
    }

    /**
     * @return Application|Factory|View
     */
    public function userServices()
    {
        $userServices = UserService::with('service')->where('user_id', '=', Auth::id())
            ->orderByDesc('id')->get();

        return view('service/user_services', ['userServices' => $userServices]);
    }
}
