<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Listing;
use Illuminate\Http\Request;
use App\Services\TagCounter;

class SearchController extends Controller
{
    private $result_per_page;

    public function __construct()
    {
        $this->result_per_page = 10;
    }
    /**
     * Displays search results
     *
     * @param Illuminate\Http\Request $request
     */
    public function index(Request $request)
    {
        $search_term = $request->input('q');

        $popular_tags = Tag::popular()->get();

        $listings = Listing::search($search_term)
                    ->where('status','approved')
                    ->paginate($this->result_per_page);

        // break keywords
        // match keywords to tags
        // update tag count

        return view('searchResult')->with([
            'listings' => $listings,
            'popular_tags' => $popular_tags
        ]);
    }

    /**
     * Search tags
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response 
     */
    public function searchTag(Request $request)
    {
        $search_term = $request->input('q');

        $result = Tag::search($search_term)->get();

        //increase tag count

        return response()->json([
            'success' => true,
            'result' => $result->toArray()
        ]);
    }

    /**
     * Search by selected tag
     *
     * @param Illuminate\Http\Request $request
     */
    public function searchListingByTag(Request $request)
    {
        $search_term = $request->input('q');

        $tag = Tag::search($search_term)->first();

        $popular_tags = Tag::popular()->get();

        if ($tag !== null) {
            
            $listings = $tag->listings()
                        ->where('status','approved')
                        ->paginate($this->result_per_page);

            TagCounter::increment($tag);
            
        } else {
            $listings = null;
        }

        return view('searchResult')->with([
            'listings' => $listings,
            'popular_tags' => $popular_tags
        ]);
    }
}
