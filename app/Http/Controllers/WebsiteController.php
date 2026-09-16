<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Member;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }
    /**
     * Display a listing of the resource.
     */
    public function showProject(Project $project)
    {

        $seoData = new SEOData(
            title: $project->title . ' | Projects | RAPID Tanzania',
            description: Str::limit(strip_tags($project->description), 155),
            author: 'RAPID Tanzania',
           
        );

        $images =$project->images;

        return view('website.project-detail', compact('project','images','seoData'));
    

        
    }
    /**
     * Display a listing of the resource.
     */
    public function eventList()
    {

        $events = Event::latest()->paginate(10);

        $seoData = new SEOData(
            title: 'Events & Activities | RAPID Tanzania',
            description: 'Check out all the latest events and activities organized by RAPID Tanzania related to disaster risk reduction and humanitarian response.',
            author: 'RAPID Tanzania',
            
        );

        return view('website.event-list', compact('events', 'seoData'));
        
    }
    /**
     * Display a listing of the resource.
     */
    public function eventShow(Event $event)
    {


    
$seoData = new SEOData(
            title: $event->name . ' | Event Detail | RAPID Tanzania',
            description: Str::limit(strip_tags($event->description), 155),
            author: 'RAPID Tanzania',
             
        );
        $images = $event->images;

        return view('website.event-detail', compact('event', 'seoData','images'));

        
        
    }
    /**
     * Display a listing of the resource.
     */
    public function contactForm()
    {
    $seoData = new SEOData(
            title: 'Contact Us | RAPID Tanzania',
            description: 'Get in touch with the RAPID Tanzania team for inquiries on projects, events, or partnerships.',
            author: 'RAPID Tanzania',
          
        );
        return view('website.contact', compact('seoData'));
      
    }
    public function aboutUs()
    {

    $seoData = new SEOData(
            title: 'Contact Us | RAPID Tanzania',
            description: 'Get in touch with the RAPID Tanzania team for inquiries on projects, events, or partnerships.',
            author: 'RAPID Tanzania',
          
        );
        return view('website.about',compact("seoData"));
    }
    /**
     * Display a listing of the resource.
     */
    public function members()
    {

        $members = Member::all();

         $seoData = new SEOData(
            title: 'Our Team & Members | RAPID Tanzania',
            description: 'Meet the dedicated team members and experts at RAPID Tanzania driving disaster risk reduction, climate resilience, and effective humanitarian efforts.',
            author: 'RAPID Tanzania',
          
        );

        return view('website.team', compact('members', 'seoData'));
        
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
        //
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
}
