<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.profiles.index');
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
        $userId = Auth::id();

        $user = User::findOrFail($userId);
        $user->bio = $request->bio;
        $user->update();

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function changePassword(Request $request)
    {

        $request->validate([
            'old_password' => ['required'],
            'password' => ['required', 'confirmed']
        ]);

        $user =  $request->user();



        if (! Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => "The provided password is not a current password."]);
        }



        $user->password = Hash::make($request->password);
        $user->update();



        return back()->with("success", 'Successfull Update Your passord');
    }
    public function changePicture(Request $request)
    {
        $request->validate([
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {

            DB::transaction(function () use ($request) {

                if ($request->hasFile('profile')) {
                    // Delete the old profile file from storage
                    if ($request->profile) {
                        Storage::disk('public')->delete($request->profile);
                    }

                    // Store the new profile
                    $data['profile'] = $request->file('profile')->store('profiles/images', 'public');
                } else {
                    // If no new profile, ensure we don't try to save a null path if one already exists
                    unset($data['profile']);
                }

                $userId = Auth::id();
                $user = User::findOrfail($userId);
                $user->profile_img = $data["profile"];
                $user->update();
            });

            return back()->with("success", 'Successfull Update Your Profile');
        } catch (\Throwable $th) {
            flash()->success('Error Due to :' . $th->getMessage());
        }
    }
}
