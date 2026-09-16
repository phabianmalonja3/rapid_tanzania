<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Storage;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Illuminate\Http\Response as IlluminateHttpResponse;
use Illuminate\Support\Facades\Hash; // Import Hash facade

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::latest();

        if ($request->search) {
            $search = "%" . $request->search . "%";
            $query->where(function ($q) use ($search) {
                $q->where('email', 'like', $search)
                    ->orWhere('last_name', 'like', $search)
                    ->orWhere('first_name', 'like', $search);
            });
        }

        $users = $query->paginate(10);

        // SEO Data for the user list page (Admin/Staff area)
        $seoData = new SEOData(
            title: 'User Management',
            robots: 'noindex, nofollow'
        );

        return view('pages.user.user-list', compact('users', 'seoData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $seoData = new SEOData(
            title: 'Create New User',
            robots: 'noindex, nofollow'
        );
        // The view receives a null user for "Create" mode
        return view('pages.user.create-user', ['user' => null, 'seoData' => $seoData]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       



        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'], // Ignore current user
            'role' => ['nullable', 'string', 'exists:roles,name'], // For Spatie roles
            'profile_img' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'bio' => ['nullable', 'string', 'max:500'],
        ]);
$validated['password'] =Str::random(8);

        $user = null; // Initialize user variable

        try {
            DB::transaction(function () use ($validated, &$user) {
                $user = User::create([
                    'name'       => $validated['first_name'] . ' ' . $validated['last_name'], // Combine names for 'name' field
                    'first_name' => $validated['first_name'],
                    'last_name'  => $validated['last_name'],
                    'password'   => $validated['password'],
                    'email'      => $validated['email'],
                    'slug'      => Str::slug($validated['first_name'] . ' ' . $validated['last_name']),

                ]);

                $user->assignRole($validated["role"] ?? "user");
            });

            flash()->success('New user added successfully!');
            // Return the generated password for display/copy
            return back()->with('password', $validated['password']);
        } catch (Throwable $e) {
            Log::error('User creation failed: ' . $e->getMessage(), ['exception' => $e]);
            flash()->error('User creation failed. Please try again. Error: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Retrieve dynamic SEO data for the profile page
        $seoData = $user->getDynamicSEOData();
        return view('pages.user.show', compact("user", "seoData"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // ⭐️ IMPROVEMENT: Use dynamic SEO data for the form
        $seoData = $user->getDynamicSEOData();
        $seoData->title = 'Edit ' . $user->name; // Adjust title for the form page
        $seoData->robots = 'noindex, nofollow';

        return view('pages.user.create-user', compact('user', 'seoData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // 1. Validation Rules
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id], // Ignore current user
            'role' => ['nullable', 'string', 'exists:roles,name'], // For Spatie roles
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'profile_img' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'bio' => ['nullable', 'string', 'max:500'],
        ];

        $validatedData = $request->validate($rules);

        // 2. Prepare Data
        $validatedData['name'] = $validatedData['first_name'] . ' ' . $validatedData['last_name'];

        $validatedData['slug'] =  Str::slug($validatedData['name']);
        // Remove password if it's empty/null (do not hash empty string)
        if (empty($validatedData['password'])) {
            unset($validatedData['password']);
        } else {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        // 3. Handle Profile Image Upload
        if ($request->hasFile('profile_img')) {
            // Delete old image
            if ($user->profile_img) {
                Storage::disk('public')->delete($user->profile_img);
            }
            $validatedData['profile_img'] = $request->file('profile_img')->store('profiles', 'public');
        } else {
            unset($validatedData['profile_img']); // Do not overwrite with null unless requested
        }

        try {
            DB::transaction(function () use ($user, $validatedData) {
                // ... update user fields

                // Sync the role using Spatie/laravel-permission methods
                $user->syncRoles([$validatedData['role']]);
                $user->update($validatedData);

                // 4. Update Role (Spatie)
                if (isset($validatedData['role'])) {
                    $user->syncRoles($validatedData['role']);
                }

                // 5. Update SEO (if the user has an SEO record)
                if ($user->seo) {
                    $fullImageURL = $user->profile_img ? asset('storage/' . $user->profile_img) : null;
                    $description = Str::limit($validatedData['bio'] ?? $user->bio ?? 'User profile', 160, '...');

                    $user->seo()->update([
                        'title' => $validatedData['name'] . ' Profile',
                        'description' => $description,
                        'image' => $fullImageURL,
                    ]);
                }
            });

            flash()->success('User profile updated successfully!');
            return redirect()->route('users.index');
        } catch (Throwable $e) {
            Log::error('User update failed: ' . $e->getMessage(), ['exception' => $e]);
            flash()->error('User update failed. Please try again.');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            
            // ⭐️ IMPROVEMENT: Delete profile image before deleting user record
            if ($user->profile_img) {
                Storage::disk('public')->delete($user->profile_img);
            }

            $user->delete();
            flash()->success("User deleted successfully.");
            return back();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            flash()->error("User not found.");
            return back();
        } catch (Throwable $e) {
            Log::error('User deletion failed: ' . $e->getMessage(), ['exception' => $e]);
            flash()->error('User deletion failed. Please try again.');
            return back();
        }
    }
}
