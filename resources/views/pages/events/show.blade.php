@extends('layouts.app')


@section('main')
    <section class="section">
        <div class="container">
            <x-nav-bar />
            <x-side-bar />
        </div>
        {{-- <div class="chocolat-wrapper" id="chocolat-content-1" style="display: none;"><div class="chocolat-overlay" style="display: none;"></div><div class="chocolat-loader"></div><div class="chocolat-content" style="overflow: visible; width: 55.44px; height: 39.6px; left: 572.28px; top: 55px;"><img class="chocolat-img" src="assets/img/blog/img08.png"></div><div class="chocolat-top"><span class="chocolat-close"></span></div><div class="chocolat-left active"></div><div class="chocolat-right" style=""></div><div class="chocolat-bottom"><span class="chocolat-fullscreen"></span><span class="chocolat-description">Image 8</span><span class="chocolat-pagination">8 /8</span><span class="chocolat-set-title"></span></div></div> --}}
        <div class="chocolat-wrapper" id="chocolat-content-3" style="display: none;">
            <div class="chocolat-overlay" style="display: none;"></div>
            <div class="chocolat-loader"></div>
            <div class="chocolat-content" style="overflow: visible; width: 350px; height: 250px; left: 593px; top: 222.6px;">
                <img class="chocolat-img" src="assets/img/blog/img01.png">
            </div>
            <div class="chocolat-top"><span class="chocolat-close"></span></div>
            <div class="chocolat-left active" style=""></div>
            <div class="chocolat-right" style=""></div>
            <div class="chocolat-bottom"><span class="chocolat-fullscreen"></span><span class="chocolat-description">Image
                    9</span><span class="chocolat-pagination">12 /12</span><span class="chocolat-set-title"></span></div>
        </div>
        <div class="main-content" style="min-height: 600px;">
            <section class="section">
                <div class="section-body">

                    <div class="row">
                        <div class="col-12 col-md-10 col-lg-8 mx-auto">
                            <div class="card card-primary">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4>Event: {{ $event->name }}</h4>
                                    <div>
                                        {{-- Edit Button --}}
                                        <a href="{{ route('events.edit', $event->slug ?? 1) }}" class="btn btn-warning btn-sm mr-2"
                                            title="Edit Event">
                                            <i class="fas fa-pencil-alt"></i> Edit
                                        </a>
                                        {{-- Back Button --}}
                                        <a href="{{ route('events.index') }}" class="btn btn-secondary btn-sm"
                                            title="Back to List">
                                            <i class="fas fa-list"></i> Back to Events
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="row mb-3">
                                        <div class="col-md-3 font-weight-bold">Event Name:</div>
                                        <div class="col-md-9">{{ $event->name }}</div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3 font-weight-bold">Location:</div>
                                        <div class="col-md-9">{{ $event->location }}</div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3 font-weight-bold">Start Date:</div>
                                        <div class="col-md-9">
                                            {{ \Carbon\Carbon::parse($event->start_at)->format('l, F jS, Y') }}</div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3 font-weight-bold">End Date:</div>
                                        <div class="col-md-9">
                                            {{ \Carbon\Carbon::parse($event->end_at)->format('l, F jS, Y') }}</div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3 font-weight-bold">Created By:</div>
                                        {{-- Assuming a 'user' relationship is defined in the Event model --}}
                                        <div class="col-md-9">{{ $event->user->name ?? 'Unknown Author' }}</div>
                                    </div>

                                    <hr>

                                    <h6 class="font-weight-bold">Description:</h6>
                                    <p>{{ $event->description }}</p>

                                </div>
                               


                                <div class="card-header">Galary </div>
                                <div class="card-body">
                                    <div class="gallery gallery-md">

                                        @php
                                            $images = $event->images ?? [];
                                        @endphp
                                        
                           @if (empty($images))
                               
                           <div class="alert alert-info text-center">
                            **No Image Uploaded **
                           </div>
                               
                           @else
                              @foreach($images as $index => $file)
                                            <div class="gallery-item" data-image="{{ asset('storage/' . $file) }}"
                                                data-title="Image {{ $index }}"
                                                href=" {{ asset('storage/' . $file) }} " title="Image {{ $index }}"
                                                style="background-image: url(&quot; {{ asset('storage/' . $file) }} &quot;);">
                                            </div>
                            @endforeach
  
                           @endif


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> {{-- End row --}}
            </section>
            


        </div>
    </section>
@endsection
