<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;

class TagsController extends Controller
{
    /**
     * Displays tag list
     *
     * @param 
     */
    public function index()
    {
        $tags = Tag::with('listings')->orderBy('tag_count','desc')->paginate(10);

        return view('admin.tags')->with([
            'tags' => $tags
        ]);
    }
 
    /**
     * Creates a new tag
     *
     * @param App\Http\Requests\TagRequest;
     */
    public function store(TagRequest $request)
    {
        Tag::store($request->all());

        return back();
    }

    /**
     * Deletes a tag
     *
     * @param App\Tag
     */
    public function destroy(Tag $tag) 
    {
        if ($tag->listings() !== null) {
            $tag->listings()->detach();
        }

        $tag->delete();

        return redirect(route('tag.index'));
    }
}
