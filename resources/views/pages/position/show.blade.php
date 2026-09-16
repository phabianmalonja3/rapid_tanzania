@extends('layouts.app')

<x-title>Position Details: {{ $position->name }}</x-title>

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
                                    <h4>position : {{ $position->name }}</h4>
                                    <div>
                                        {{-- Edit Button --}}
                                        <a href="{{ route('positions.edit', $position->slug) }}" class="btn btn-warning btn-sm mr-2"
                                            title="Edit position">
                                            <i class="fas fa-pencil-alt"></i> Edit
                                        </a>
                                        {{-- Back Button --}}
                                        <a href="{{ route('positions.index') }}" class="btn btn-secondary btn-sm"
                                            title="Back to List">
                                            <i class="fas fa-list"></i> Back to positions
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="row mb-3">
                                        <div class="col-md-3 font-weight-bold">position Name:</div>
                                        <div class="col-md-9">{{ $position->name }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 font-weight-bold">position Description:</div>
                                        <div class="col-md-9">{{ $position->description }}</div>
                                    </div>

                                    

                                    <div class="row mb-3">
                                        <div class="col-md-3 font-weight-bold">Registerd Date:</div>
                                        <div class="col-md-9">
                                            {{ \Carbon\Carbon::parse($position->created_at)->format('l, F jS, Y') }}</div>
                                    </div>



                                    <hr>



                                </div>

                            </div>
                        </div>
                    </div> {{-- End row --}}

                </div> {{-- End section-body --}}
            </section>
        </div> {{-- End main-content --}}
    </section>
@endsection
