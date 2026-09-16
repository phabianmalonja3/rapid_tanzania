@extends('layouts.app')

@php
// Detect mode (Edit or Create)
$isEdit = isset($category) && $category->exists;

$formTitle = $isEdit ? 'Edit Category' : 'Create New Category';
$formRoute = $isEdit ? route('categories.update', $category->id) : route('categories.store');
$submitButtonText = $isEdit ? 'Update Category' : 'Create Category';
$formMethod = $isEdit ? 'PUT' : 'POST';
@endphp

<x-title>{{ $formTitle }}</x-title>

@section('main')
<section class="section">
  <div class="container">
    <x-nav-bar />
    <x-side-bar />
  </div>


    <div class="main-wrapper main-wrapper-1">
      
      <div class="main-content">
        <section class="section">
          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>{{ $formTitle }}</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{ $formRoute }}" method="post" enctype="multipart/form-data">
                      @csrf
                      @method($formMethod)

                      {{-- Category Name --}}
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category Name</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="text" id="name" class="form-control" name="name"
                                 value="{{ old('name', $category->name ?? '') }}"
                                 placeholder="Enter category name" required>
                          @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                      </div>

                      {{-- Slug --}}
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Slug</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="text" id="slug" class="form-control" name="slug"
                                 value="{{ old('slug', $category->slug ?? '') }}"
                                 placeholder="Auto-generated slug" readonly>
                          <small class="form-text text-muted">Slug is generated automatically.</small>
                          @error('slug')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                      </div>

                      {{-- Submit Button --}}
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
        </section>
      </div>
    </div>
 




@endsection

@pushOnce('scripts')
    <script>
document.addEventListener('DOMContentLoaded', function () {

    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    if (nameInput && slugInput) {

        nameInput.addEventListener('keyup', function () {
            let slug = nameInput.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '') // remove special chars
                .trim()
                .replace(/\s+/g, '-');        // spaces → dashes

            slugInput.value = slug;
        });

    }

});
</script>
@endPushOnce

