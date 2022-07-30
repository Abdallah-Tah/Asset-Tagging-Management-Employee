<?php

namespace App\Http\Controllers;

use App\Models\AmazonSite;
use App\Models\SettingSite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $amazonSites = SettingSite::where('user_id', auth()->user()->id)
            ->with('amazonSite')
            ->groupBy('status')
            ->get();

        $amazonSite_select = AmazonSite::where('user_id', auth()->user()->id)->get();
        
        return view('setting-sites.index', compact('amazonSites', 'amazonSite_select'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* $validator = $request->validate([
            'amazon_site_id' => 'required|exists:amazon_sites,id',
            'status' => 'required|in:completed,in-progress,pending, incomplete',
        ]); */
        $site_id = json_encode($request->amazon_site_id);
        $settingSite = new SettingSite();
        $settingSite->user_id = auth()->user()->id;
        $settingSite->amazon_site_id = $site_id;
        $settingSite->status = $request->status;
        $settingSite->save();

        $settingSite->amazonSite()->sync($request->amazon_site_id);

        return redirect()->route('setting-sites.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SettingSite  $settingSite
     * @return \Illuminate\Http\Response
     */
    public function show(SettingSite $settingSite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SettingSite  $settingSite
     * @return \Illuminate\Http\Response
     */
    public function edit(SettingSite $settingSite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SettingSite  $settingSite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SettingSite $settingSite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SettingSite  $settingSite
     * @return \Illuminate\Http\Response
     */
    public function destroy(SettingSite $settingSite)
    {
        //
    }
}
