@extends('layouts.app')

@php
    // Determine if we are creating or editing
    $isEdit = isset($position) && $position->exists;
    $formTitle = $isEdit ? 'Edit position' : 'Create New position';
    $formRoute = $isEdit ? route('positions.update', $position->slug) : route('positions.store');
    $formMethod = $isEdit ? 'POST' : 'POST'; // Use POST but include @method('PUT') below for updates
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
                        {{-- Centered Form Column --}}
                        <div class="col-md-12 col-lg-6 justify-center mx-auto">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4>{{ $formTitle }}</h4>
                                </div>
                                <div class="card-body">

                                    {{-- Random Password Alert (Only for Create) --}}


                                    {{-- Form Start --}}
                                    <form action="{{ $formRoute }}" method="POST">
                                        @csrf
                                        @if ($isEdit)
                                            @method('PUT') {{-- Required for Update route --}}
                                        @endif

                                        {{-- 1. First Name --}}
                                        <div class="form-group">
                                            <label>Position Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name', $position->name ?? '') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-0">
                                            <label>Description</label>
                                            <textarea class="form-control" required="" name="description" >{{ old('description', $position->description ?? '') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>




                                        <div class="card-footer text-right">
                                            <button class="btn btn-primary mr-1"
                                                type="submit">{{ $isEdit ? 'Update position' : 'Create position' }}</button>
                                            <button class="btn btn-secondary" type="reset">Reset</button>
                                        </div>
                                    </form>

                                </div> {{-- End card --}}
                            </div> {{-- End col --}}
                        </div> {{-- End row --}}

                    </div> {{-- End section-body --}}
            </section>
        </div> {{-- End main-content --}}
    </section>
@endsection

