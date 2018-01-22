<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ResourcesReserved implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

	public $drones;
	public $pilots;
	public $technicians;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($drones, $pilots, $technicians)
    {
        $this->drones = $drones;
		$this->pilots = $pilots;
		$this->technicians = $technicians;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('my-channel');
    }

	public function broadcastWith()
	{
		return [
            'drones' => $this->drones,
            'pilots' => $this->pilots,
            'technicians' => $this->technicians
        ];
	}
}
