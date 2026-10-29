
@extends('layouts.main')

@section('main')
<main class="main">
    <section class="page-title">
        <div class="container">
            <h1>Create Gallery Activity</h1>
            <p>Add a new activity to the RAPID Tanzania gallery.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="gallery-edit-card">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @include('gallery.form', ['gallery' => new \App\Models\Gallery()])

            </div>
        </div>
    </section>
</main>
@endsection
