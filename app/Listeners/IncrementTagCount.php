<?php

namespace App\Listeners;

use App\Events\SearchByTag;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncrementTagCount implements ShouldQueue
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
     * Increment the tag count by 1.
     *
     * @param  App\Events\SearchByTag  $event
     * @return void
     */
    public function handle(SearchByTag $event)
    {
        $event->tag->tag_count = (int)$event->tag->tag_count + 1;

        $event->tag->save();
    }
}
