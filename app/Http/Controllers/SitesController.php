<?php

namespace App\Http\Controllers;

use App\Site;
use App\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SitesController extends Controller
{
    public function __construct() {
        // Only authenticated users can access the site resource.
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sites.index', ['sites' => auth()->user()->sites]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sites.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $this->validateSite();
        $attributes['user_id'] = auth()->id();

        // Generate unique token for the site based on its URL.
        $attributes['token'] = Hash::make($attributes['url']);
        Site::create($attributes);
        return redirect('/sites')->with('message', 'New site was created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {
        // Apply update policy.
        $this->authorize('update', $site);

        // Get paginated collection of visits for the given site.
        $visits = Visit::where('site_id', $site->id)->paginate(10);
        return view('sites.show', ['site' => $site, 'visits' => $visits]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site)
    {
        // Apply update policy.
        $this->authorize('update', $site);

        $site->delete();
        return redirect('/sites');
    }

    protected function validateSite() {
        return request()->validate([
            'title' => ['required'],
            'url' => ['required', 'url', 'unique:sites']
        ]);
    }
}
