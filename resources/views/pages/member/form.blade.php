@extends('layouts.app')

@php
    // 1. Determine if we are in "Edit" mode (if $member exists and has an ID) or "Create" mode
    $isEdit = isset($member) && $member->exists;

    // 2. Set dynamic variables for the form, updated for 'members'
    $formTitle = $isEdit ? 'Edit member' : 'Create New member';
    // Assuming your resource routes are named 'members.store' and 'members.update'
    $formRoute = $isEdit ? route('members.update', $member->slug) : route('members.store');
    $submitButtonText = $isEdit ? 'Update member' : 'Create member';
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
                                    <form method="POST" action="{{ $formRoute }}" class="needs-validation" enctype="multipart/form-data"
                                        novalidate="">
                                        @csrf
                                        @method($formMethod) {{-- Set method to POST or PUT --}}

                                        {{-- 1. Name Field --}}
                                        <div class="form-group">
                                            <label for="name">member Full Name</label>
                                            <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                                id="name" name="full_name" value="{{ old('full_name', $member->full_name ?? '') }}"
                                                required autofocus>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label>Position</label>

                                            @use("App\Models\Position","Position" )
                                            
                                            @php

                                        $postions = Position::all();

                                            @endphp
                                            <select class="form-control @error('role') is-invalid @enderror" name="position_id" required>

                                                @foreach ( $postions as $position )
                                                    <option value="{{ $position->id }}" >{{ $position->name }}</option>
                                                @endforeach
                                                
                                                
                                            </select>
                                            @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                         {{-- 4. Featured Image --}}
                                        <div class="form-group">
                                            <label for="image">Featured Image</label>
                                            
                                            {{-- Show current image in Edit mode --}}
                                            @if ($isEdit && $member->image)
                                                <div class="mb-2">
                                                    <img src="{{ asset('storage/' . $member->image) }}" alt="Current Image" style="width: 200px; height: auto; border-radius: 4px;">
                                                    <small class="form-text text-muted">Current image. Upload a new file to replace it.</small>
                                                </div>
                                            @endif

                                            <input type="file" id="image" class="form-control-file @error('image') is-invalid @enderror" 
                                                   name="image">
                                            
                                            @if (!$isEdit)
                                                 <small class="form-text text-muted">Image is required for a new Member.</small>
                                            @endif

                                            @error('image')
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
