@extends('layouts.app')

@section('main')

<section class="section">

    {{-- Page Header --}}
    <div class="section-header">
        <h1>Upload Video</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('dashboad') }}">Dashboard</a>
            </div>

            <div class="breadcrumb-item">
                <a href="{{ route('videos.index') }}">Videos</a>
            </div>

            <div class="breadcrumb-item active">
                Upload Video
            </div>
        </div>
    </div>

    {{-- Page Body --}}
    <div class="section-body">

        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">

                <div class="card">

                    <div class="card-header">
                        <h4>
                            <i data-feather="video"></i>
                            Upload Video
                        </h4>
                    </div>

                    <form
                        action="{{ route('videos.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf

                        <div class="card-body">

                            {{-- Errors --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- Video --}}
                            <div class="form-group">

                                <label for="video">
                                    Select Video
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="custom-file">

                                    <input
                                        type="file"
                                        name="video"
                                        id="video"
                                        class="custom-file-input @error('video') is-invalid @enderror"
                                        accept="video/*"
                                        required
                                    >

                                    <label
                                        class="custom-file-label"
                                        for="video"
                                    >
                                        Choose video
                                    </label>

                                </div>

                                <small class="form-text text-muted">
                                    Select the video you want to upload.
                                </small>

                                @error('video')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Video Preview --}}
                            <div
                                id="video-preview-container"
                                class="mt-4"
                                style="display: none;"
                            >

                                <label>Video Preview</label>

                                <video
                                    id="video-preview"
                                    controls
                                    style="
                                        width: 100%;
                                        max-height: 400px;
                                        border-radius: 8px;
                                        background: #000;
                                    "
                                ></video>

                            </div>

                        </div>

                        <div class="card-footer text-right">

                            <a
                                href="{{ route('videos.index') }}"
                                class="btn btn-secondary"
                            >
                                <i data-feather="arrow-left"></i>
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                <i data-feather="upload"></i>
                                Upload Video
                            </button>

                        </div>

                    </form>

                </div>

            </div>
        </div>

    </div>

</section>

@endsection

@push('scripts')

<script>
    document.getElementById('video').addEventListener('change', function (event) {

        const file = event.target.files[0];

        if (!file) {
            return;
        }

        const preview = document.getElementById('video-preview');
        const container = document.getElementById('video-preview-container');
        const label = document.querySelector('.custom-file-label');

        preview.src = URL.createObjectURL(file);

        container.style.display = 'block';

        label.textContent = file.name;
    });
</script>

@endpush