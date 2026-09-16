<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $words = Word::query()
        ->orderBy('created_at', 'desc')
        ->paginate(10); // 10 items per page

    return Inertia::render('Dashboard', [
        'words' => $words->items(),
        'pagination' => [
            'current_page' => $words->currentPage(),
            'last_page' => $words->lastPage(),
            'per_page' => $words->perPage(),
            'total' => $words->total(),
        ],
        'flash' => session('flash', [])
    ]);
      
        return Inertia::render('Dashboard',['words'=>$words]);
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
        $request->validate(['text' => 'required|string']);

       
    $sentence = $request->input('text');

       $words = explode(' ', $sentence );


       DB::beginTransaction();
       foreach ($words as $wordText) {
        $trimmedWordText = trim($wordText);
        // Avoid saving empty words and create only if it doesn't exist
        if ($trimmedWordText !== '') {
            Word::firstOrCreate(['text' => $trimmedWordText]);
        }
    }
    DB::commit();

    return redirect()->back(); // or 
    }

    /**
     * Display the specified resource.
     */
  

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Word $word)
    {
        $request->validate([
            'text' => 'required|string|max:255',
        ]);
    
        $word->text = $request->text;
        $word->save();
    
     
    return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Word $word)
    {
        try {
            DB::beginTransaction();
            $word->delete();
            DB::commit();
        } catch (\Throwable $th) {

            DB::rollback();
            //throw $th;
        }
    }
}
