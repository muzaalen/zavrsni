<?php

namespace App\Events;

use App\User;

//use Illuminate\Broadcasting\Channel;
//use Illuminate\Broadcasting\InteractsWithSockets;
//use Illuminate\Broadcasting\PresenceChannel;
//use Illuminate\Broadcasting\PrivateChannel;
//use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
//use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserCreatedEvent
{
    use/*Dispatchable, InteractsWithSockets,*/ SerializesModels;

    public $user;

    use SerializesModels;

    public $order;

    /**
     * Create a new event instance.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    
}
