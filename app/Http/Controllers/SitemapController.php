<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Spatie\Sitemap\Sitemap;
use Illuminate\Http\Request;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{

//     Route::get('/website/members', [WebsiteController::class, 'members'])->name('member-list');
// Route::get('/website/event/', [WebsiteController::class, 'eventList'])->name('event-list');
// Route::get('/website/event/{event}', [WebsiteController::class, 'eventShow'])->name('event-view');
// Route::get('/website/contact', [WebsiteController::class, 'contactForm'])->name('contact');
// Route::get('/website/about', [WebsiteController::class, 'aboutUs'])->name('about');
// Route::get('/website/project/view/{project}', [WebsiteController::class, 'showProject'])->name('project-show');

     public function generate()
    {
        // Create sitemap instance
        $sitemap = Sitemap::create();

        // Add static pages
        $sitemap->add(Url::create('/'));
        $sitemap->add(Url::create('/website/event/'));
        $sitemap->add(Url::create('/website/about'));
        $sitemap->add(Url::create('/about'));
        $pjs = Project::all();
        foreach ($pjs as $pj ) {

            $sitemap->add(Url::create('/website/project/view/',$pj->slug));
        }

        // Add blog posts dynamically
        $posts = \App\Models\Post::all();
        foreach ($posts as $post) {
            $sitemap->add(Url::create("/posts/" . $post->slug));
        }
        $events = \App\Models\Event::all();
        foreach ($events as $event) {
            $sitemap->add(Url::create("/events/" . $event->slug));
        }
        $evts = \App\Models\Event::all();
        foreach ($evts as $event) {
            $sitemap->add(Url::create("/website/event/" . $event->slug));
        }
        $project = \App\Models\Project::all();
        foreach ($project as $project) {
            $sitemap->add(Url::create("/projects/" . $project->slug));
        }
        $members = \App\Models\Member::all();
        foreach ($members as $project) {
            $sitemap->add(Url::create("/members/" . $project->slug));
        }
        $categories = \App\Models\Project::all();
        foreach ($categories as $project) {
            $sitemap->add(Url::create("/categories/" . $project->slug));
        }

        // Save as public/sitemap.xml
        $sitemap->writeToFile(public_path('sitemap.xml'));

        return response()->json([
            'message' => 'Sitemap generated successfully!',
            'file' => url('sitemap.xml'),
        ]);
    }
}
