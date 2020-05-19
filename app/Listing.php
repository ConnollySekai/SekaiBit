<?php

namespace App;

use DB;
use App\Tag;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Listing extends Model
{
    use Notifiable, Searchable;

    protected $fillable = [
        'contact_email',
        'business_name',
        'website_url',
        'products_services',
        'status',
        'accepts_bitcoin',
        'city',
        'country'
    ];

    /**
     * Retries listing based on their status
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param String $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRetrieve($query, $status)
    {
        return $query->where('status', $status)
                    ->orderBy('created_at', 'desc');
    }

    /**
     * Set listing status
     *
     * @param App\Listing $listing
     * @param String $status
     */
    public static function setStatus(Listing $listing, $status)
    {
        $listing->status = $status;

        $listing->save();
    }

    /**
     * Creates an new listing record
     *
     * @param Array $input
     * @return mixded
     */
    public static function store(Array $input)
    {
        $data = [
            'business_name' => $input['businessName'],
            'website_url' => $input['websiteUrl'],
            'contact_email' => $input['contactEmail'],
            'accepts_bitcoin' => ($input['acceptsBitcoin']) ? '1': '0',
            'products_services' => $input['productsServices']
        ];

        if ($input['hasPhysicalStore']) {

            $data['city'] = $input['city'];
            
            $data['country'] = $input['country'];
        }

        $created = DB::transaction(function() use($data, $input){

            $created = self::create($data);

            $tags = $input['searchTags'];

            if (count($tags)) {

                foreach ($tags as $tag) {

                    Tag::createAndAttach($created, $tag);
                }
            }

            return $created;
        });

        

        return $created;
    }

    /**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return array|string
     */
    public function routeNotificationForMail($notification)
    {
        return $this->contact_email;
    }

    /**
     * Tags belong to listing
     *
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
