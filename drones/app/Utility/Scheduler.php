<?php
/**
 * Created by PhpStorm.
 * User: Giovanna
 * Date: 12/01/2018
 * Time: 11:06
 */

namespace App\Utility;

interface Scheduler
{
	public function getTimeDelivery($journeySlots);
	public function confirmedOrder();
	public function cancelOrder();
}
