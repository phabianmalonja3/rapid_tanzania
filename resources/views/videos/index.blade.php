
@extends('layouts.app')

@section('main')

    <section class="section">

        <div class="container">
            <x-nav-bar />
            <x-side-bar />
        </div>

        {{-- Page Header --}}


          <div class="main-content" style="min-height: 600px;">
            <section class="section">
                <div class="row">
        <div class="section-header">
            <h1>Videos</h1>

            <div class="section-header-button">
                <a href="{{ route('videos.create') }}" class="btn btn-primary">
                    <i data-feather="plus"></i>
                    Add Video
                </a>
            </div>
        </div>

        <div class="section-body mx-10">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">

                <div class="breadcrumb-item">
                    <a href="{{ route('dashboad') }}">
                        Dashboard
                    </a>
                </div>

                <div class="breadcrumb-item active">
                    Videos
                </div>

            </div>

            {{-- Videos Card --}}
            <div class="card">

                {{-- Card Header --}}
                <div class="card-header">

                    <h4>
                        <i data-feather="video"></i>
                        Video List
                    </h4>

                    <div class="card-header-form">

                        <form
                            action="{{ route('videos.index') }}"
                            method="GET"
                        >

                            <div class="input-group">

                                <input
                                    type="text"
                                    name="search"
                                    class="form-control"
                                    placeholder="Search videos..."
                                    value="{{ request('search') }}"
                                >

                                <div class="input-group-btn">

                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        <i data-feather="search"></i>
                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

                {{-- Card Body --}}
                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-hover">

                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th>Video</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th class="text-right">Action</th>
                                </tr>

                            </thead>

                            <tbody>

                                @forelse ($videos as $video)

                                    <tr>

                                        {{-- Number --}}
                                        <td>
                                            {{ $videos->firstItem() + $loop->index }}
                                        </td>

                                        {{-- Video --}}
                                        <td>

                                            <div
                                                style="
                                                    width: 120px;
                                                    height: 70px;
                                                    background: #f1f1f1;
                                                    border-radius: 6px;
                                                    overflow: hidden;
                                                "
                                            >

                                                @if(!empty($video->thumbnail))

                                                    <img
                                                        src="{{ asset('storage/' . $video->thumbnail) }}"
                                                        alt="{{ $video->title }}"
                                                        style="
                                                            width: 100%;
                                                            height: 100%;
                                                            object-fit: cover;
                                                        "
                                                    >

                                                @else

                                                    <div
                                                        class="d-flex align-items-center justify-content-center"
                                                        style="height: 100%;"
                                                    >

                                                        <i
                                                            data-feather="video"
                                                            style="
                                                                width: 30px;
                                                                height: 30px;
                                                            "
                                                        ></i>

                                                    </div>

                                                @endif

                                            </div>

                                        </td>

                                        {{-- Title --}}
                                        <td>
                                            <strong>
                                                {{ $video->title }}
                                            </strong>
                                        </td>

                                      
                                        <td>
                                            {{ $video->category->name ?? 'N/A' }}
                                        </td>

                                        <td>

                                            @if($video->status)

                                                <span class="badge badge-success">
                                                    Active
                                                </span>

                                            @else

                                                <span class="badge badge-secondary">
                                                    Inactive
                                                </span>

                                            @endif

                                        </td>

                                        {{-- Created At --}}
                                        <td>
                                            {{ $video->created_at?->format('d M Y') }}
                                        </td>

                                        {{-- Actions --}}
                                        <td class="text-right">

                                            {{-- View --}}
                                            <a
                                                href="{{ route('videos.show', $video->id) }}"
                                                class="btn btn-info btn-sm"
                                                title="View"
                                            >
                                                <i data-feather="eye"></i>
                                            </a>

                                         

                                            {{-- Delete --}}
                                            <form
                                                action="{{ route('videos.destroy', $video->id) }}"
                                                method="POST"
                                                style="display:inline-block;"
                                                onsubmit="return confirm('Are you sure you want to delete this video?')"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    title="Delete"
                                                >
                                                    <i data-feather="trash-2"></i>
                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="7"
                                            class="text-center py-5"
                                        >

                                            <div class="mb-3">

                                                <i
                                                    data-feather="video"
                                                    style="
                                                        width: 50px;
                                                        height: 50px;
                                                        opacity: .4;
                                                    "
                                                ></i>

                                            </div>

                                            <h5>
                                                No Videos Found
                                            </h5>

                                            <p class="text-muted">
                                                You haven't added any videos yet.
                                            </p>

                                            <a
                                                href="{{ route('videos.create') }}"
                                                class="btn btn-primary"
                                            >
                                                <i data-feather="plus"></i>
                                                Add Video
                                            </a>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

                {{-- Pagination --}}
                @if($videos->hasPages())

                    <div class="card-footer text-right">

                        {{ $videos->withQueryString()->links() }}

                    </div>

                @endif

            </div>

        </div>
                </div>
            </section>
          </div>

    </section>

@endsection
