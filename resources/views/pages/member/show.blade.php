@extends('layouts.app')

<x-title>Member's Details: {{ $member->name }}</x-title>

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
                                    <h4>member: {{ $member->name }}</h4>
                                    <div>
                                        {{-- Edit Button --}}
                                        <a href="{{ route('members.edit', $member->slug) }}" class="btn btn-warning btn-sm mr-2" title="Edit member">
                                            <i class="fas fa-pencil-alt"></i> Edit
                                        </a>
                                        {{-- Back Button --}}
                                        <a href="{{ route('members.index') }}" class="btn btn-secondary btn-sm" title="Back to List">
                                            <i class="fas fa-list"></i> Back to members
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="row mb-3">
                                        <div class="col-md-3 font-weight-bold">member Name:</div>
                                        <div class="col-md-9">{{ $member->full_name }}</div>
                                    </div>
                                    
                                    

                                    <div class="row mb-3">
                                        <div class="col-md-3 font-weight-bold">Registered At</div>
                                        <div class="col-md-9">{{ \Carbon\Carbon::parse($member->created_at)->format('l, F jS, Y') }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 font-weight-bold">Profile </div>
                                        <div class="col-md-9"> 

                                            <img src="{{ asset('storage/'.$member->image) }}" alt="{{ $member->full_name }}" width="300" >
                                        </div>
                                    </div>

                                    
                                    
                                    

                                    <hr>

                                    
                                </div>
                                <div class="card-footer bg-whitesmoke text-right">
                                    <small class="text-muted">member created on {{ $member->created_at->format('M d, Y') }}</small>
                                </div>
                            </div>
                        </div>
                    </div> {{-- End row --}}

                </div> {{-- End section-body --}}
            </section>
        </div> {{-- End main-content --}}
    </section>
@endsection