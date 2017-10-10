<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnterpriseTransport;
use App\Models\MaitreTransport;
use App\Models\OrderTransport;
use App\Http\Controllers\OrderTransportController;

class OrderTransportController extends Controller
{
	public function newOrder(MaitreTransport $maitre, EnterpriseTransport $enterprise)
    {
    }

	public function setAddress($address)
	{
	}
}
