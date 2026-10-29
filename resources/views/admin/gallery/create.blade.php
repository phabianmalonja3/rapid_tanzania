@extends('layouts.main')

@section('main')
<main class="main">
    <section class="section py-5">
        <div class="container">

            <div class="mb-4">
                <a href="{{ route('admin.gallery.index') }}" class="text-decoration-none">
                    <i class="bi bi-arrow-left"></i> Back to Gallery
                </a>

                <h2 class="mt-3 mb-1">Add Gallery Activity</h2>
                <p class="text-muted">Add a new activity, its details, and an image.</p>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    @include('admin.gallery.form', [
                        'gallery' => $gallery,
                        'action' => route('admin.gallery.store'),
                        'method' => 'POST',
                    ])
                </div>
            </div>

        </div>
    </section>
</main>
@endsection