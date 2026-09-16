@extends('layouts.app')

@php
    // 1. Determine if we are in "Edit" mode (if $client exists and has an ID) or "Create" mode
    $isEdit = isset($client) && $client->exists;

    // 2. Set dynamic variables for the form, updated for 'clients'
    $formTitle = $isEdit ? 'Edit client' : 'Create New client';
    // Assuming your resource routes are named 'clients.store' and 'clients.update'
    $formRoute = $isEdit ? route('clients.update', $client->id) : route('clients.store');
    $submitButtonText = $isEdit ? 'Update client' : 'Create client';
    $formMethod = $isEdit ? 'PUT' : 'POST'; // Use PUT for update
@endphp

<x-title>{{ $formTitle }}</x-title>

@section('main')
    <section class="section">
        <div class="container">
            {{-- Assuming these components exist and are still needed --}}
            <x-nav-bar />
            <x-side-bar />
        </div>

        <div class="main-content" style="min-height: 600px;">
            <section class="section">
                <div class="section-body">

                    <div class="row">
                        <div class="col-12 col-md-8 col-lg-8 mx-auto">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4>{{ $formTitle }} Form</h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ $formRoute }}" class="needs-validation"
                                        novalidate="" enctype="multipart/form-data">
                                        @csrf
                                        @method($formMethod) {{-- Set method to POST or PUT --}}

                                        {{-- 1. Name Field --}}
                                        <div class="form-group">
                                            <label for="name">client Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', $client->name ?? '') }}"
                                                required autofocus>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                      

                                         <div class="form-group">
                                            <label for="profile">Featured profile</label>
                                            
                                            {{-- Show current profile in Edit mode --}}
                                            @if ($isEdit && $client->profile)
                                                <div class="mb-2">
                                                    <img src="{{ asset('storage/' . $client->profile) }}" alt="Current profile" style="width: 200px; height: auto; border-radius: 4px;">
                                                    <small class="form-text text-muted">Current profile. Upload a new file to replace it.</small>
                                                </div>
                                            @endif

                                            <input type="file" id="profile" class="form-control-file @error('profile') is-invalid @enderror" 
                                                   name="profile">
                                            
                                            @if (!$isEdit)
                                                 <small class="form-text text-muted">profile is required for a new client.</small>
                                            @endif

                                            @error('profile')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                       
                                       
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> {{-- End row --}}

                </div> {{-- End section-body --}}
            </section>
        </div> {{-- End main-content --}}
    </section>
@endsection
