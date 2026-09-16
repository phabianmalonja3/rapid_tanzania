@extends('layouts.app')

@php
    // 1. Determine if we are in "Edit" mode (if $event exists and has an ID) or "Create" mode
    $isEdit = isset($event) && $event->exists;

    // 2. Set dynamic variables for the form, updated for 'events'
    $formTitle = $isEdit ? 'Edit Event' : 'Create New Event';
    // Assuming your resource routes are named 'events.store' and 'events.update'
    $formRoute = $isEdit ? route('events.update', $event->slug) : route('events.store');
    $submitButtonText = $isEdit ? 'Update Event' : 'Create Event';
    $formMethod = $isEdit ? 'PUT' : 'POST'; // Use PUT for update
@endphp

<x-title>{{ $formTitle }}</x-title>

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
                                            <label for="name">Event Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', $event->name ?? '') }}"
                                                required autofocus>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- 2. Description Field --}}
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                rows="5" required>{{ old('description', $event->description ?? '') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- 3. Location Field --}}
                                        <div class="form-group">
                                            <label for="location">Location</label>
                                            <input type="text"
                                                class="form-control @error('location') is-invalid @enderror" id="location"
                                                name="location" value="{{ old('location', $event->location ?? '') }}"
                                                required>
                                            @error('location')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- 4. Start At Field (Using datetime-local) --}}
                                        <div class="form-group">
                                            <label for="start_at">Start Date</label>
                                            @php
                                                $start_at_value = old('start_at', $event->start_at ?? null);
                                                if ($start_at_value && is_string($start_at_value)) {
                                                    // Updated format to YYYY-MM-DD for date input
                                                    $start_at_value = \Carbon\Carbon::parse($start_at_value)->format(
                                                        'Y-m-d',
                                                    );
                                                }
                                            @endphp
                                            {{-- Changed input type to 'date' --}}
                                            <input type="date"
                                                class="form-control @error('start_at') is-invalid @enderror" id="start_at"
                                                name="start_at" value="{{ $start_at_value }}" required>
                                            @error('start_at')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="end_date">End Date</label>
                                            @php
                                                $end_date_value = old('end_date', $event->end_date ?? null);
                                                if ($end_date_value && is_string($end_date_value)) {
                                                    // Updated format to YYYY-MM-DD for date input
                                                    $end_date_value = \Carbon\Carbon::parse($end_date_value)->format(
                                                        'Y-m-d',
                                                    );
                                                }
                                            @endphp
                                            {{-- Changed input type to 'date' --}}
                                            <input type="date"
                                                class="form-control @error('end_date') is-invalid @enderror" id="end_date"
                                                name="end_date" value="{{ $end_date_value }}" required>
                                            @error('end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="image">Featured Image</label>


                                            @php
                                                $images = $event->images ?? [];
                                            @endphp

                                            {{-- Show current image in Edit mode --}}
                                            @if ($isEdit && $images)
                                                <div class="mb-2">
                                                    <div class="card-body">
                                                        @forelse ($images as $image)
                                                            <img src="{{ asset('storage/' . $image) }}" alt="Current Image"
                                                                style="width: 100px; height: auto; border-radius: 4px;">
                                                        @empty
                                                        @endforelse

                                                    </div>
                                                    <small class="form-text text-muted">Current image. Upload a new file to
                                                        replace it.</small>
                                                </div>
                                            @endif

                                            <input type="file" id="images" multiple
                                                class="form-control-file @error('images') is-invalid @enderror"
                                                name="images[]">

                                            @if (!$isEdit)
                                                <small class="form-text text-muted">Images is required for a new
                                                    Events.</small>
                                            @endif

                                            @error('image')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- 6. auth_id (Hidden Field - Assuming current user's ID for creation, or existing user's ID for edit) --}}
                                        @if ($isEdit)
                                            <input type="hidden" name="auth_id" value="{{ $event->auth_id }}">
                                        @endif

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
            {{-- Assuming these components exist and are still needed --}}
            
    

      
@endsection
