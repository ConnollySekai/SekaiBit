<?php

namespace App;

use App\Listing;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Tag extends Model
{
    use Searchable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag_name', 'tag_count',
    ];

    /**
     * Returns a collection of tag sorted by popularity
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePopular($query)
    {
        return $query->limit(10)
                    ->whereHas('listings', function($query) {
                        $query->where('status','approved');
                    })
                    ->orderBy('tag_count','desc');     
    }

    /**
     * Find tag by name
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param String $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindByName($query, $name)
    {
        return $query->where('tag_name', $name);
    }

    /**
     * Creates a new tag
     *
     * @param Array $input
     * @return mix
     */
    public static function store(Array $input)
    {
        $data = [
            'tag_name' => strtolower($input['tag_name']),
            'tag_count' => $input['tag_count']
        ];

        $created = self::create($data);

        return $created;
    }

    /**
     * Create or attach a tag to a listing
     *
     * @param App\Listing $lisitng
     * @param Array $tag_info
     * @return 
     */
    public static function createAndAttach(Listing $listing, Array $tag_info)
    {
        if ($tag_info['id'] === null) {

            $tag = self::findByName($tag_info['tagName'])->first();

            if ($tag !== null) {    
                $listing->tags()->save($tag);
            } else {
                $listing->tags()->create([
                    'tag_name' => strtolower($tag_info['tagName']),
                    'tag_count' => 0
                ]);
            }
        } else {

            $tag = self::findOrFail($tag_info['id']);

            $listing->tags()->save($tag);
        }
    }

    /**
     * The listing that belong to the tag.
     */
    public function listings()
    {
        return $this->belongsToMany('App\Listing');
    }
}
