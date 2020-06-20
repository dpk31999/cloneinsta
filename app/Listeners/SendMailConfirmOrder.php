<?php

namespace App\Listeners;

use App\Events\CustomerOrder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailConfirmOrder
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CustomerOrder  $event
     * @return void
     */
    public function handle(CustomerOrder $event)
    {
        //
    }
}
