<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Member;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::with('position')->latest()->get(); // Eager load position

        $seoData = new SEOData(
            title: 'Our Team Members',
            description: 'Meet the key staff and organizational members of our team.',
            robots: 'index, follow'
        );

        return view('pages.member.index', compact('members', 'seoData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $seoData = new SEOData(
            title: 'Add New Team Member',
            robots: 'noindex, nofollow'
        );
        return view('pages.member.form', ['member' => null, 'seoData' => $seoData]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validation Rules
        $validatedData = $request->validate([
            'full_name' => ['required','string','max:255'],
            // Ensure uniqueness check ignores the current record ID (though irrelevant for store)
            'position_id' => ['required', 'exists:positions,id'], 
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        $imagePath = null;
        

        $validatedData['slug']=Str::slug($validatedData['full_name']);
        try {
            DB::transaction(function () use ($validatedData, $request, &$imagePath) {
                // 2. Handle File Upload (before Model creation)
                $imagePath = $request->file('image')->store('members/images', 'public');

                $member = Member::create([
                    'full_name' => $validatedData['full_name'],
                    'image' => $imagePath,
                    'position_id' => $validatedData['position_id'],
                    'slug'=>$validatedData['slug']
                ]);
                
             
                
            });
            
            flash()->success('New member saved successfully!');
            return redirect()->route("members.index");

        } catch (Throwable $th) {
            // Rollback: If transaction fails, delete the uploaded file
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            Log::error('Member creation failed: ' . $th->getMessage(), ['exception' => $th]);
            flash()->error("Failed to create member due to: " .$th->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        // ⭐️ SEO: Retrieve dynamic SEO data for the single member profile
        $seoData = $member->getDynamicSEOData();
        return view('pages.member.show', compact("member", "seoData"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        // ⭐️ SEO: Set SEO data for the edit form
        $seoData = $member->getDynamicSEOData();
        $seoData->title = 'Edit Member: ' . $member->full_name;
        $seoData->robots = 'noindex, nofollow';

        return view("pages.member.form", compact("member", "seoData"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        
        // 1. Validation Rules
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            // ⭐️ FIX: Check unique position_id, but ignore the current member's ID
            'position_id' => ['required','exists:positions,id'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        $validatedData['slug']=Str::slug($validatedData["full_name"]);

        $data = $validatedData;
        
        try {
            DB::transaction(function () use ($request, $member, $data) {
                // 2. Handle File Update
                if ($request->hasFile('image')) {
                    // Delete the old image file from storage
                    if ($member->image) {
                        Storage::disk('public')->delete($member->image);
                    }
                    
                    // Store the new image
                    $data['image'] = $request->file('image')->store('members/images', 'public');
                } else {
                    // If no new image, ensure we don't try to save a null path if one already exists
                    unset($data['image']);
                }
                
                // 3. Update the Member
                $member->update($data);

                // 4. Update SEO
                if ($member->seo) {
                    $fullImageURL = $member->image ? asset('storage/' . $member->image) : null;
                    $positionName = $member->position->name ?? 'Team Member'; // Assuming position relationship exists
                    $member->seo()->update([
                        'title' => $data['full_name'] . ' - ' . $positionName,
                        'image' => $fullImageURL,
                    ]);
                }
            });

            flash()->success('Member updated successfully!');
            return redirect()->route('members.index');

        } catch (Throwable $th) {
            Log::error('Member update failed: ' . $th->getMessage(), ['exception' => $th]);
            flash()->error("Failed to update member due to: " .$th->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        try {
            DB::transaction(function () use ($member) {
                // ⭐️ FIX: Check for $member->image, not $member->profile
                if ($member->image) {
                    Storage::disk('public')->delete($member->image);
                }
                
                $member->delete();
            });

            flash()->success('Member deleted successfully!');
            return redirect()->route('members.index');
            
        } catch (Throwable $th) {
            Log::error('Member deletion failed: ' . $th->getMessage(), ['exception' => $th]);
            flash()->error("Failed to delete member due to: " .$th->getMessage());
            return back();
        }
    }
}