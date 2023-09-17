<?php

namespace App\Listeners;

use App\Events\StopTyping;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StopTypingListener
{
   /**
     * Handle the event.
     *
     * @param  StartTyping  $event
     * @return void
     */
    public function handle(StopTyping $event)
    {
        // You can access the data passed with the event using $event->data
        $user = $event->data['user'];

        // You can perform any actions or logic here when the StartTyping event is triggered.
        // For example, you can update a user's typing status in the database or perform other tasks.
    }
}
