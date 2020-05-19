<?php

namespace App\Http\Controllers;

use App\Listing;
use Illuminate\Http\Request;
use App\Http\Requests\ListingRegistrationRequest;

class ListingController extends Controller
{
    /**
     * Displays business listings
     *
     * @param  Illuminate\Http\Request $request
     */
    public function index(Request $request)
    {
        $status = $request->input('status') ? $request->input('status'): 'new';

        $listing = Listing::retrieve($status)->paginate(10);

        return view('admin.listing')->with([
            'listing' => $listing
        ]);
    }

    /**
     * Creates a listing record
     *
     * @param  App\Http\Request\ListingRegistrationRequest $request
     */
    public function store(ListingRegistrationRequest $request)
    {
        if ($request->input('currentStep') === 2) {
            
            $listing = Listing::store($request->all());
            
            $step = 2;
        } else {
            $step = 1;
        }

        return response()->json([
            'success' => true,
            'step' => $step
        ]);
    }
    

    /**
     * Creates a listing record
     *
     * @param  Illuminate\Http\Request $request
     * @param  App\Listing $listing
     */
    public function update(Request $request, Listing $listing)
    {
        $status = $request->input('status');

        Listing::setStatus($listing, $status);

        return back();
    }

    /**
     * Deletes a listing
     *
     * @param App\Listing
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();

        return back();
    }
}
