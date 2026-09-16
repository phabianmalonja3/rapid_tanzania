@extends('layouts.app')

@section('main')

<section class="section">
    <div class="container">
        <x-nav-bar />
        <x-side-bar />
    </div>
    
    <div class="main-content" style="min-height: 600px;">
        <section class="section">
            <div class="section-body">

                {{-- Page Header --}}
                <div class="section-header d-flex justify-content-between align-items-center">
                    <h1>Video Details</h1>
                    <div>
                        {{-- Back Button --}}
                        <a href="{{ route('videos.index') }}" class="btn btn-secondary btn-sm" title="Back to List">
                            <i class="fas fa-list"></i> Back to Videos
                        </a>
                    </div>
                </div>

                {{-- Breadcrumb --}}
                <div class="breadcrumb mb-4">
                    <div class="breadcrumb-item">
                        <a href="{{ route('dashboad') }}">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="{{ route('videos.index') }}">Videos</a>
                    </div>
                    <div class="breadcrumb-item active">
                        {{ $video->title }}
                    </div>
                </div>

                {{-- Main Content Grid --}}
                <div class="row">
                    
                    {{-- Left Column: Video Preview --}}
                    <div class="col-lg-8 col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Video Preview</h4>
                            </div>
                            <div class="card-body p-0">
                                <div style="background: #000; width: 100%; display: flex; align-items: center; justify-content: center;">
                                    
                                    @if($video->url)
                                        <video 
                                            controls 
                                            style="width: 100%; height: auto; max-height: 70vh; display: block;"
                                            poster="{{ $video->thumbnail ? asset('storage/' . $video->thumbnail) : '' }}"
                                        >
                                            <source src="{{ $video->url }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @elseif($video->video_file)
                                        <video 
                                            controls 
                                            style="width: 100%; height: auto; max-height: 70vh; display: block;"
                                            poster="{{ $video->thumbnail ? asset('storage/' . $video->thumbnail) : '' }}"
                                        >
                                            <source src="{{ asset('storage/' . $video->video_file) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @else
                                        <div class="text-white text-center py-5">
                                            <i data-feather="video-off" style="width: 50px; height: 50px; opacity: 0.5;"></i>
                                            <p class="mt-2">No video source available</p>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Video Information --}}
                    <div class="col-lg-4 col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4><i data-feather="info" class="mr-2"></i> Video Information</h4>
                            </div>
                            <div class="card-body">
                                
                                {{-- Title --}}
                                <div class="row mb-3">
                                    <div class="col-md-4 font-weight-bold">Title:</div>
                                    <div class="col-md-8">{{ $video->title ?? 'N/A' }}</div>
                                </div>

                                {{-- Category --}}
                                <div class="row mb-3">
                                    <div class="col-md-4 font-weight-bold">Category:</div>
                                    <div class="col-md-8">{{ $video->category->name ?? 'N/A' }}</div>
                                </div>

                                {{-- Status --}}
                                <div class="row mb-3">
                                    <div class="col-md-4 font-weight-bold">Status:</div>
                                    <div class="col-md-8">
                                        @if($video->status)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-secondary">Inactive</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Created At --}}
                                <div class="row mb-3">
                                    <div class="col-md-4 font-weight-bold">Created At:</div>
                                    <div class="col-md-8">
                                        {{ \Carbon\Carbon::parse($video->created_at)->format('l, F jS, Y') }}
                                    </div>
                                </div>

                                {{-- Last Updated --}}
                                <div class="row mb-3">
                                    <div class="col-md-4 font-weight-bold">Last Updated:</div>
                                    <div class="col-md-8">
                                        {{ \Carbon\Carbon::parse($video->updated_at)->format('l, F jS, Y') }}
                                    </div>
                                </div>

                            </div>

                            {{-- Card Footer: Buttons --}}
                            <div class="card-footer">
                                <div class="row">
                                   
                                    <div class="col-6">
                                        <form action="{{ route('videos.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Una uhakika unataka kufuta video hii?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-block">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </section>
    </div>

</section>

@endsection