<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class DonateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function donate()
    {

        $seoData = new SEOData(
    title: 'Donate',
    description: 'Support our mission by making a donation. Your contribution helps fund community projects, youth programs, and empowerment initiatives.',
    robots: 'index, follow'
);

        return view('pages.donate.index',compact('seoData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Volunteer $volunteer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Volunteer $volunteer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Volunteer $volunteer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Volunteer $volunteer)
    {
        //
    }
}
