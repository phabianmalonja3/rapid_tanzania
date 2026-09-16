@extends('layouts.app')
@php
// 1. Determine if we are in "Edit" mode (if $project exists and has an ID) or "Create" mode
$isEdit = isset($project) && $project->exists;

// 2. Set dynamic variables for the form, updated for 'projects'
$formTitle = $isEdit ? 'Edit project' : 'Create New project';
// Assuming your resource routes are named 'projects.store' and 'projects.update'
$formRoute = $isEdit ? route('projects.update', $project->slug) : route('projects.store');
$submitButtonText = $isEdit ? 'Update project' : 'Create project';
$formMethod = $isEdit ? 'PUT' : 'POST'; // Use PUT for update
$currentCategoryId = old('category_id', $project->category_id ?? null);
@endphp

<x-title>{{ $formTitle }}</x-title>
@section('main')
<section class="section">
  <div class="container">
    <x-nav-bar />
    <x-side-bar />
  </div>
  <div class="main-wrapper main-wrapper-1">
    <div class="navbar-bg"></div>

    <!-- Main Content -->
    <div class="main-content">
      <section class="section">
        <div class="section-body">


          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Create Project</h4>
                </div>
                <div class="card-body">
                  <form action="{{$formRoute }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method($formMethod)
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" name="title"
                          value="{{ old('title', $project->title ?? '') }}">
                        @error('title')<div class="text-danger">{{ $message }}</div>@enderror
                      </div>
                    </div>

                    @use("App\Models\Category","Category" )

                    @php
                    $categories = Category::all();
                    @endphp


                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
                      <div class="col-sm-12 col-md-7">
                        <select class="form-control selectric" name="category_id" required>
                          <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>-- Select Category --
                          </option>
                          @foreach($categories as $category)
                          {{-- ⭐️ CORE IMPROVEMENT HERE --}}
                          <option value="{{ $category->id }}" {{ $currentCategoryId==$category->id ? 'selected' : '' }}
                            >
                            {{ $category->name }}
                          </option>
                          @endforeach

                        </select>
                        @error('category_id')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror

                      </div>

                    </div>


                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Images</label>
                  <div class="col-sm-12 col-md-7">
                    <label>Images</label>

                    <input type="file" class="form-control" name="images[]" value="" accept=".png,.jpeg,.jpg,.svg"
                      multiple>




                    <small class="form-text text-muted">You can upload more Than images</small>


                    @error('images.*')<div class="text-danger">{{ $message }}</div>@enderror



                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Attachment File</label>
                  <div class="col-sm-12 col-md-7">
                    <label>Attachment File</label>

                    <input type="file" class="form-control" name="attachment"
                      value="{{ old('attachment', $project->attachment ?? '') }}" accept=".pdf,.xlsx,.xls,.doc,docx">
                    <small class="form-text text-muted">its optional File should be pdf,docx,excel only</small>
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                  <div class="col-sm-12 col-md-7">
                    <textarea class="summernote" name="content">{{ old('content', $project->content ?? '') }}</textarea>
                    @error('content')<div class="text-danger">{{ $message }}</div>@enderror
                  </div>
                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                  <div class="col-sm-12 col-md-7">
                    <button class="btn btn-primary" type="submit">{{ $submitButtonText }}</button>
                  </div>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>

    </div>
  </div>
</section>
@endsection