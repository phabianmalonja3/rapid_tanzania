<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\Post;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap.xml';

    public function handle()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/'))             // Home page
            ->add(Url::create('/about'))        // About page
            ->add(Url::create('/contact'));     // Contact page

        // Add all posts dynamically
        $posts = Post::all();
        foreach ($posts as $post) {
            $sitemap->add(Url::create("/posts/{$post->slug}"));
        }
        $events = Event::all();
        foreach ($events as $event) {
            $sitemap->add(Url::create("/events/{$event->id}"));
        }
        // $posts = Post::all();
        // foreach ($posts as $post) {
        //     $sitemap->add(Url::create("/posts/{$post->slug}"));
        // }

        // Write to public folder
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully!');
    }
}
