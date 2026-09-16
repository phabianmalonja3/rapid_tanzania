<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $seoData = new SEOData(
            title: 'Position | News & Updates from Rapid Tanzania',
            description: 'Stay updated with the latest news, projects, and insights on disaster risk reduction and humanitarian response from RAPID Tanzania.',
            author: 'RAPID Tanzania',
        );

        $positions = Position::latest()->paginate(5);
        return view("pages.position.index",compact("positions",'seoData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

         $seoData = new SEOData(
            title: 'Create Position | News & Updates from Rapid Tanzania',
            description: 'Stay updated with the latest news, projects, and insights on disaster risk reduction and humanitarian response from RAPID Tanzania.',
            author: 'RAPID Tanzania',
        );
        return view('pages.position.form',compact('seoData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validated = $request->validate([
            'name'=>['required','string','unique:positions,name,except,id'],
            "description"=>['required','string','min:3']
        ]);

        $validated['slug']=Str::slug($validated['name']);

        try {

            DB::transaction(function () use($validated){
                
                Position::create($validated);
            });

            flash()->success('New Postion Has Create');
            return redirect()->route('positions.index');

            //code...
        } catch (\Throwable $th) {

            flash()->error("Failed To save Due to :".$th->getMessage());
            return back();
            //throw $th;
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
$seoData = new SEOData(
            title: $position->name.'| News & Updates from Rapid Tanzania',
            description: 'Stay updated with the latest news, projects, and insights on disaster risk reduction and humanitarian response from RAPID Tanzania.',
            author: 'RAPID Tanzania',
        );

        return view('pages.position.show',compact("position",'seoData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {

        $seoData = new SEOData(
            title: $position->name.' Edit Position | News & Updates from Rapid Tanzania',
            description: 'Stay updated with the latest news, projects, and insights on disaster risk reduction and humanitarian response from RAPID Tanzania.',
            author: 'RAPID Tanzania',
        );
        return view('pages.position.form',compact('position','seoData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {

       $validated = $request->validate([
            'name'=>['required','string'],
            "description"=>['required','string','min:3']
        ]);

        $validated['slug']=Str::slug($validated['name']);


        try {

            DB::transaction(function () use($validated,$position){
                
                $position->update($validated);
            });

            flash()->success(' Postion Has Update');
            return redirect()->route('positions.index');

            //code...
        } catch (\Throwable $th) {

            flash()->error("Failed To Update Due to :".$th->getMessage());
            return back();
         
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
         try {

            DB::transaction(function () use($position){
                
                $position->delete();
            });

            flash()->success(' Postion Has Delete');
            return redirect()->route('positions.index');

            //code...
        } catch (\Throwable $th) {

            flash()->error("Failed To Delete Due to :".$th->getMessage());
            return back();
         
        }
    }
}
