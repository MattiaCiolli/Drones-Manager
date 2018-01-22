<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Drone;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function redirectTo()
    {
        return '/newOrder';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('newOrder');
    }

	public function getDiaries()
	{
		$drones = Drone::where('type', 'drone')->get();
		$pilots = Drone::where('type', 'pilot')->get();
		$technicians = Drone::where('type', 'technician')->get();

		return view('diaries', ["drones" => $drones, "pilots" => $pilots, "technicians" => $technicians]);
	}
}
