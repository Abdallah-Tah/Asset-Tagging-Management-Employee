<?php

namespace App\Http\Controllers;

use App\Models\AmazonSite;
use App\Imports\SitesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AmazonSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = AmazonSite::all();
        return view('amazon.sites.index', compact('sites'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AmazonSite  $amazonSite
     * @return \Illuminate\Http\Response
     */
    public function show(AmazonSite $amazonSite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AmazonSite  $amazonSite
     * @return \Illuminate\Http\Response
     */
    public function edit(AmazonSite $amazonSite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AmazonSite  $amazonSite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AmazonSite $amazonSite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AmazonSite  $amazonSite
     * @return \Illuminate\Http\Response
     */
    public function destroy(AmazonSite $amazonSite)
    {
        //
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/sites', $filename);
        }
        Excel::import(new SitesImport, public_path('uploads/sites/' . $filename));
        return back()->with('success', 'Import Successful');
    }
}
