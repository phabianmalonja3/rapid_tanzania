@extends('layouts.app')

@section('main')
    
            {{-- Assuming standard dashboard components like nav-bar and side-bar exist --}}
         <section class="section">
        <div class="container">
            <x-nav-bar />
            <x-side-bar />
        </div>
        
        <div class="main-content" style="min-height: 600px;">
            <section class="section">
                <div class="section-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4>Manage Blog Posts</h4>
                                    {{-- Link to the post creation form --}}
                                    <a href="{{ route('posts.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus-circle mr-1"></i> Create New Post
                                    </a>
                                </div>
                                <div class="card-body">

                                    {{-- Success/Error Messages --}}
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                                {{ session('success') }}
                                            </div>
                                        </div>
                                    @endif

                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="postsTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>Author</th>
                                                    <th>Status</th>
                                                    <th>Image</th>
                                                    <th>Created At</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- Check if $posts variable exists and is iterable --}}
                                                @forelse($posts as $post)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            {{ $post->title }}
                                                            <small class="d-block text-muted">{{ $post->slug }}</small>
                                                        </td>
                                                        {{-- Assuming you have a Post -> User relationship defined --}}
                                                        <td>{{ $post->user->name ?? 'N/A' }}</td> 
                                                        <td>
                                                            @if($post->published)
                                                                <div class="badge badge-success">Published</div>
                                                            @else
                                                                <div class="badge badge-warning">Draft</div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($post->image)
                                                                {{-- Displaying a thumbnail of the featured image --}}
                                                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Thumbnail" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                                            @else
                                                                No Image
                                                            @endif
                                                        </td>
                                                        <td>{{ $post->created_at->format('M d, Y') }}</td>
                                                        <td>
                                                            {{-- Show Button --}}
                                                            <a href="{{ route('posts.show', $post->slug) }}" class="btn  btn-info" title="View Post">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            
                                                       

                                                             <form action="{{ route('posts.destroy', ['post'=>$post->slug]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?')" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger" title="Delete">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>

                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center">No posts found. <a href="{{ route('posts.create') }}">Start writing one!</a></td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
         </section>
@endsection

{{-- Script for handling the confirmation before delete --}}
@push('scripts')
<script>
    // Note: We are using custom modal/confirmation logic instead of window.confirm()
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const postId = this.getAttribute('data-id');
                
                // --- CUSTOM CONFIRMATION LOGIC GOES HERE ---
                // For demonstration, we'll use a console log, but in a real app,
                // you would display a Bootstrap/Tailwind modal here asking for confirmation.
                
                console.log(`Confirm deletion for post ID: ${postId}. Replacing window.confirm() with custom UI.`);
                
                // If confirmed (via your custom modal logic):
                // document.getElementById(`delete-form-${postId}`).submit();

                // Placeholder for simple execution (REMOVE THIS IN PRODUCTION!)
                if (confirm('Are you sure you want to delete this post? (Requires custom modal in production)')) {
                    document.getElementById(`delete-form-${postId}`).submit();
                }
            });
        });
    });
</script>
@endpush