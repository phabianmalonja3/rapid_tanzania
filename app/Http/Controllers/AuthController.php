<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RalphJSmit\Laravel\SEO\Support\SEOData;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
          $seoData = new SEOData(
            title: 'Login | Rapid Tanzania',
            description: 'Meet the key staff and organizational members of our team.',
            robots: 'index, follow'
        );

        return view('pages.auth.login',compact('seoData'));
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function loginHandle(LoginRequest $request)
    {

        $request->validated();

        if (!Auth::attempt($request->only('email', 'password'))) {

            return back()->withErrors(['email' => "invalid credials please try again ..."]);
        }

        $request->session()->regenerate();
        return redirect()->route('dashboad');
    }
    
   
    public function logoutHandle(Request $request)
{
    Auth::logout(); // Logs out the user

    $request->session()->invalidate(); // Invalidate the session
    $request->session()->regenerateToken(); // Regenerate CSRF token

    return redirect()->route('login'); // Redirect to login page
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
  

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
