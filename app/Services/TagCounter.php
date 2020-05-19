<?php 

namespace App\Services;

use App\Tag;
use App\Events\SearchByTag;
use Illuminate\Support\Facades\Cache;

class TagCounter
{
    /**
     * Increase the search tag counter
     *
     * @param App\Tag $tag;
     * @return 
     */
    public static function increment(Tag $tag)
    {
        $ip = request()->ip();
        
        $time = strtotime('1 day', 0);

        $tag_name = $tag->tag_name;

        $cache_key = $ip."|".$tag_name;

        //only update if ip and tag name not in cache
        if (!Cache::has($cache_key)) {
            
            Cache::put($cache_key, time(),$time);
            
            event(new SearchByTag($tag));
        } 

        
    }
}