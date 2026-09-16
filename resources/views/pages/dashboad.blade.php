@extends('layouts.app')
<x-title>Dashboad</x-title>
@section('main')

  <section class="section">
        <div class="container">
            <x-nav-bar />
            <x-side-bar />
        </div>
    <div class="main-content" style="min-height: 171px;">
        <section class="section">
            <div class="row ">
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Users</h5>
                                            @use("App\Models\User", "User")

                                            @php
                                            $userCount = User::count();
                                            @endphp

                                            <h2 class="mb-3 font-18">{{ $userCount }}</h2>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="assets/img/banner/1.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15"> Members</h5>

                                            @use("App\Models\Member", "Member")

                                            @php
                                            $member = Member::count();
                                            @endphp

                                            <h2 class="mb-3 font-18">{{ $member }}</h2>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="assets/img/banner/2.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Projects</h5>

                                            @use("App\Models\Project", "Project")

                                            @php
                                            $project = Project::count();
                                            @endphp

                                            <h2 class="mb-3 font-18">{{ $project }}</h2>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="assets/img/banner/3.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Events</h5>

                                            @use("App\Models\Event", "Event")

                                            @php
                                            $event = Event::count();
                                            @endphp

                                            <h2 class="mb-3 font-18">{{ $event }}</h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="assets/img/banner/4.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <!-- Support tickets -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Recent Posts</h4>
                            <form class="card-header-form">
                                <input type="text" name="search" class="form-control" placeholder="Search">
                            </form>
                        </div>
                        <div class="card-body">

                            @foreach ($posts as $post)

                            <div class="support-ticket media pb-1 mb-3">
                                <img src="{{ $post->image ? asset("storage/". $post->image ) :
                                asset('assets/img/no-profile.png') }}" class="user-img mr-2" alt="">
                                <div class="media-body ml-3">
                                    <div class="badge badge-pill badge-{{$post->published ? " success" :"warning" }}
                                        mb-1 float-right">{{ $post->published ? "Published" :"Draft" }}</div>
                                    <span class="font-weight-bold">#{{ Str::random(10); }}</span>
                                    <a href="{{ route('posts.show',['post'=>$post->slug]) }}">{{ $post->title }}</a>
                                    <p class="my-1">{{Str::substr( $post->content, 0, 99) }} ...</p>
                                    <small class="text-muted"> <i class="
fas fa-user-tie"></i> Created by <span class="font-weight-bold font-13">{{ $post->user->name == auth()->user()->name ?
                                            "Me" : $post->user->name }}</span>
                                        &nbsp;&nbsp; {{ $post->created_at }}</small>

                                </div>
                            </div>

                            @endforeach
                        </div>
                        <a href="{{ route('posts.index') }}" class="card-footer card-link text-center small ">View
                            All</a>
                    </div>
                    <!-- Support tickets -->
                </div>

         

    </div>



    </div>
  </section>
@endsection