<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NotifyJobChangeStatusEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    protected $notification;
    protected $idChanel;
    protected $countNotificationUnSeen;
    /**
     * Create a new event instance.
     */
    public function __construct($notification, $idChanel, $countNotificationUnSeen)
    {
        $this->notification = $notification;
        $this->idChanel = $idChanel;
        $this->countNotificationUnSeen = $countNotificationUnSeen;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     */
    public function broadcastOn()
    {
        return new PrivateChannel('company.' . $this->idChanel);
    }

    public function broadcastWith()
    {
        return [
            'notification' => $this->notification,
            'idChanel' => $this->idChanel,
            'countNotificationUnSeen' => $this->countNotificationUnSeen
        ];
    }
}
