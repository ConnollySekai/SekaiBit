<?php

namespace App\Observers;

use App\Listing;
use App\Notifications\ListingApproved;
use App\Notifications\ListingRejected;

class ListingObserver
{
    /**
     * Handle the listing "created" event.
     *
     * @param  \App\Listing  $listing
     * @return void
     */
    public function created(Listing $listing)
    {
        //
    }

    /**
     * Handle the listing "updated" event.
     *
     * @param  \App\Listing  $listing
     * @return void
     */
    public function updated(Listing $listing)
    {
        if ($listing->status === 'approved') {
            $type = 'success';

            if ($listing->contact_email !== null || $listing->contact_email !== '') {
                
                $listing->notify(new ListingApproved());
            }
        }

        if ($listing->status === 'rejected') {
            $type = 'error';

            if ($listing->contact_email !== null || $listing->contact_email !== '') {
                $listing->notify(new ListingRejected());
            }
        }

        session()->flash("notification",[
            'message' => $listing->business_name." ".trans('translations.was')." ".$listing->status,
            'type' => $type
        ]);
    }

    /**
     * Handle the listing "deleted" event.
     *
     * @param  \App\Listing  $listing
     * @return void
     */
    public function deleted(Listing $listing)
    {
        session()->flash("notification",[
            'message' => $listing->business_name." ".trans('translations.was')." ".trans('translations.deleted'),
            'type' => 'error'
        ]);
    }
}
