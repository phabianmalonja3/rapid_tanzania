<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\OrgClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class OrgClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = OrgClient::latest()->get();
        
        $seoData = new SEOData(
            title: 'Our Organizational Clients',
            description: 'List of all major organizational clients and partners.',
            robots: 'index, follow'
        );
        
        return view('pages.client.index', compact("clients", "seoData"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $seoData = new SEOData(
            title: 'Create New Client',
            robots: 'noindex, nofollow' // Prevent indexing of admin forms
        );

        // Pass null or an empty OrgClient instance if the view expects it
        return view('pages.client.form', ['client' => null, 'seoData' => $seoData]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validation
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // ⭐️ FIX: Changed the custom validation 'profile' to standard 'image'
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $profilePath = null;
        
        try {
            DB::transaction(function () use ($request, &$profilePath, $validatedData) {
                // 2. Handle File Upload (before DB transaction starts)
                $profilePath = $request->file('profile')->store('clients/images', 'public');

                OrgClient::create([
                    'name' => $validatedData['name'],
                    'profile' => $profilePath,
                ]);
            });
            
            flash()->success('New Client saved successfully!');
            return redirect()->route("clients.index");

        } catch (Throwable $th) {
            // 3. Rollback: If transaction fails, delete the uploaded file
            if ($profilePath) {
                Storage::disk('public')->delete($profilePath);
            }
            Log::error('Client creation failed: ' . $th->getMessage(), ['exception' => $th]);
            flash()->error("Failed to create client due to an internal error.");
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(OrgClient $client)
    {
        // Use the getDynamicSEOData method implemented on the model
        $seoData = $client->getDynamicSEOData();
        return view('pages.client.show', compact("client", "seoData"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrgClient $client)
    {
        $seoData = $client->getDynamicSEOData();
        $seoData->title = 'Edit Client: ' . $client->name; // Adjust title for the form
        $seoData->robots = 'noindex, nofollow';

        // Pass the existing client model to the unified client-form view for editing
        return view('pages.client.form', compact('client', 'seoData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrgClient $client)
    {
        // 1. Validation Rules
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // ⭐️ FIX: Changed the custom validation 'profile' to standard 'image'
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        $data = $validatedData;
        
        try {
            DB::transaction(function () use ($request, $client, &$data) {
                // 2. Handle File Update
                if ($request->hasFile('profile')) {
                    // Delete the old profile file from storage
                    if ($client->profile) {
                        Storage::disk('public')->delete($client->profile);
                    }
                    
                    // Store the new profile - ⭐️ FIX: Use consistent path 'clients/images'
                    $data['profile'] = $request->file('profile')->store('clients/images', 'public');
                } else {
                    // If no new profile, ensure we don't try to save a null path if one already exists
                    unset($data['profile']); 
                }
                
                // 3. Update the client
                $client->update($data);

                // 4. Update SEO if needed
                if ($client->seo) {
                    $fullImageURL = $client->profile ? asset('storage/' . $client->profile) : null;
                    $client->seo()->update([
                        'title' => $data['name'],
                        'image' => $fullImageURL,
                    ]);
                }
            });
        
            flash()->success('Client updated successfully!');
            return redirect()->route('clients.index');

        } catch (Throwable $th) {
            Log::error('Client update failed: ' . $th->getMessage(), ['exception' => $th]);
            flash()->error('Client update failed. Please try again.');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrgClient $client) // ⭐️ IMPROVEMENT: Using Route Model Binding
    {
        try {
            DB::transaction(function () use ($client) {
                // Delete the associated image file from storage
                if ($client->profile) {
                    Storage::disk('public')->delete($client->profile);
                }
            
                $client->delete();
            });
            
            flash()->success('Client deleted successfully!');
            return redirect()->route('clients.index');

        } catch (Throwable $th) {
            Log::error('Client deletion failed: ' . $th->getMessage(), ['exception' => $th]);
            flash()->error("Failed to delete client due to: " . $th->getMessage());
            return back();
        }
    }
}