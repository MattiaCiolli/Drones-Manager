<?php

namespace App\Http\Controllers;

use App\OrderTransport;
use Illuminate\Http\Request;

class OrderTransportController extends Controller
{
	public function newOrder($idMaitre, $idEnterprise)
    {
		return $idMaitre + $idEnterprise;
    }
}
