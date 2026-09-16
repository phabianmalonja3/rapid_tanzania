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

                    <div class="row">
                        <div class="col-12 col-md-10 col-lg-8 mx-auto">
                            <div class="card card-primary">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4>post : {{ $post->title }}</h4>
                                    <div>
                                        {{-- Edit Button --}}
                                        <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-warning btn-sm mr-2"
                                            title="Edit post">
                                            <i class="fas fa-pencil-alt"></i> Edit
                                        </a>
                                        {{-- Back Button --}}
                                        <a href="{{ route('posts.index') }}" class="btn btn-secondary btn-sm"
                                            title="Back to List">
                                            <i class="fas fa-list"></i> Back to posts
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="row mb-3">
                                        <div class="col-md-3 font-weight-bold">post Title:</div>
                                        <div class="col-md-9">{{ $post->title }}</div>
                                    </div>

                                    

                                    <div class="row mb-3">
                                        <div class="col-md-3 font-weight-bold"> Image</div>
                                        <div class="col-md-9">
                                            <img src="{{ asset('storage/'.$post->image) }}" alt="" srcset="" width="200">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 font-weight-bold">Created Date:</div>
                                        <div class="col-md-9">
                                            {{ \Carbon\Carbon::parse($post->created_at)->format('l, F jS, Y') }}</div>
                                    </div>



                                    <hr>
<div class="card-footer  ">
<div class="row mb-3 ">
                                        <div class="col-md-3 font-weight-bold">Posted By:</div>
                                        <div class="col-md-9">{{ $post->user->name }}</div>
                                    </div>
</div>


                                </div>

                            </div>
                        </div>
                    </div>
                    
                </div>
            </section>
      
@endsection
