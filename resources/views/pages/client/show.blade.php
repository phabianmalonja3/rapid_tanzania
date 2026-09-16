@extends('layouts.app')

<x-title>Client Details: {{ $client->name }}</x-title>

@section('main')
    <section class="section">
        <div class="container">
            <x-nav-bar />
            <x-side-bar />
        </div>

        <div class="main-content" style="min-height: 600px;">
            <section class="section">
                <div class="section-body">

                    <div class="row mb-4">
                        <div class="col-12 col-md-10 col-lg-8 mx-auto">
                            <div class="card card-primary">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4>client: {{ $client->name }}</h4>
                                    <div>
                                        {{-- Edit Button --}}
                                        <a href="{{ route('clients.edit', $client->id) }}"
                                            class="btn btn-warning btn-sm mr-2" title="Edit client">
                                            <i class="fas fa-pencil-alt"></i> Edit
                                        </a>
                                        {{-- Back Button --}}
                                        <a href="{{ route('clients.index') }}" class="btn btn-secondary btn-sm"
                                            title="Back to List">
                                            <i class="fas fa-list"></i> Back to clients
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="row mb-3">
                                        <div class="col-md-3 font-weight-bold">client Name:</div>
                                        <div class="col-md-9">{{ $client->name }}</div>
                                    </div>



                                    <div class="row mb-3">
                                        <div class="col-md-3 font-weight-bold">Registered At</div>
                                        <div class="col-md-9">
                                            {{ \Carbon\Carbon::parse($client->created_at)->format('l, F jS, Y') }}</div>
                                    </div>

                                   <div class="text-center ">
                                    <img src="{{ asset('storage/'.$client->profile) }}" alt="" srcset="" class="text-center border" width="200">
                                   </div>




                                    <hr>


                                </div>
                                <div class="card-footer bg-whitesmoke pb-4 text-right">
                                    <small class="text-muted">client created on
                                        {{ $client->created_at->format('M d, Y') }}</small>
                                </div>
                            </div>
                        </div>
                    </div> {{-- End row --}}

                </div> {{-- End section-body --}}
            </section>
        </div> {{-- End main-content --}}
    </section>
@endsection
