@extends('layouts.app')

@php
    // 1. Determine if we are in "Edit" mode (if $post exists and has an ID) or "Create" mode
    $isEdit = isset($post) && $post->exists;
    
    // 2. Set dynamic variables for the form
    $formTitle = $isEdit ? 'Edit Post' : 'Create New Post';
    $formRoute = $isEdit ? route('posts.update', $post->slug) : route('posts.store');
    $submitButtonText = $isEdit ? 'Update Post' : 'Create Post';
@endphp



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
                        {{-- Center the form, making it slightly wider for content --}}
                        <div class="col-12 col-md-8 mx-auto">
                            <div class="card">
                                <div class="card-header">
                                    <h4>{{ $formTitle }}</h4>
                                </div>
                                <div class="card-body">
                                    
                                    {{-- 3. Set Form Action, Method, and enctype (for file uploads) --}}
                                    <form action="{{ $formRoute }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        
                                        {{-- 4. Add the @method('PUT') directive for "Edit" mode --}}
                                        @if ($isEdit)
                                            @method('PUT')
                                        @endif

                                        {{-- 1. Title --}}
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" 
                                                   name="title" 
                                                   value="{{ old('title', $post->title ?? '') }}" 
                                                   required>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- 2. Slug --}}
                                        

                                        {{-- 3. Content --}}
                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            {{-- In a real app, replace this with a rich text editor (e.g., Trix, CKEditor) --}}
                                            <textarea id="content" class="form-control @error('content') is-invalid @enderror" 
                                                      name="content" rows="10" 
                                                      required>{{ old('content', $post->content ?? '') }}</textarea>
                                            @error('content')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- 4. Featured Image --}}
                                        <div class="form-group">
                                            <label for="image">Featured Image</label>
                                            
                                            {{-- Show current image in Edit mode --}}
                                            @if ($isEdit && $post->image)
                                                <div class="mb-2">
                                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" style="width: 200px; height: auto; border-radius: 4px;">
                                                    <small class="form-text text-muted">Current image. Upload a new file to replace it.</small>
                                                </div>
                                            @endif

                                            <input type="file" id="image" class="form-control-file @error('image') is-invalid @enderror" 
                                                   name="image">
                                            
                                            @if (!$isEdit)
                                                 <small class="form-text text-muted">Image is required for a new post.</small>
                                            @endif

                                            @error('image')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- 5. Published Status (Checkbox) --}}
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                {{-- Hidden input sends '0' if checkbox is unchecked --}}
                                                <input type="hidden" name="published" value="0">
                                                <input type="checkbox" class="custom-control-input" id="published" 
                                                       name="published" value="1" 
                                                       {{-- Check if old value exists, or if the post is published --}}
                                                       @if(old('published', $post->published ?? false)) checked @endif>
                                                <label class="custom-control-label" for="published">Publish Post</label>
                                            </div>
                                            <small class="form-text text-muted">If checked, the post will be visible to the public.</small>
                                        </div>
                                        
                                        <div class="card-footer text-right">
                                            <button class="btn btn-primary" type="submit">{{ $submitButtonText }}</button>
                                            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
                                        </div>

                                    </form>
                                </div> {{-- End card-body --}}
                            </div> {{-- End card --}}
                        </div> {{-- End col --}}
                    </div>
                     {{-- End row --}}

                </div> {{-- End section-body --}}
            </section>
        </div> 
         </section>
@endsection