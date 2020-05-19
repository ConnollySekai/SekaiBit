<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Displays the primary search page
     * 
     *@return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $popular_tags = Tag::popular()->get();

        return view('index')->with([
            'popular_tags' => $popular_tags
        ]);
    }

    /**
     * Displays advertise page
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function advertise()
    {
        return view('advertise');
    }
}
