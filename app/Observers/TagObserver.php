<?php

namespace App\Observers;

use App\Tag;

class TagObserver
{
    /**
     * Handle the tag "created" event.
     *
     * @param  \App\Tag  $tag
     * @return void
     */
    public function created(Tag $tag)
    {
        session()->flash("notification",[
            'message' => $tag->tag_name." ".trans('translations.was')." ".trans('translations.created'),
            'type' => 'success'
        ]);
    }


    /**
     * Handle the tag "deleted" event.
     *
     * @param  \App\Tag  $tag
     * @return void
     */
    public function deleted(Tag $tag)
    {
        session()->flash("notification",[
            'message' => $tag->tag_name." ".trans('translations.was')." ".trans('translations.deleted'),
            'type' => 'error'
        ]);
    }
}
