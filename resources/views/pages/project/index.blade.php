@extends('layouts.app')

<x-title>Projects List</x-title>
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
                        <div class="col-12">
                            <div class="card card-primary">

                                {{-- Card Header: Title, Add Button, and Search Bar (Combined for better UX) --}}
                                <div class="card-header">

                                    <h4>Project List</h4>

                                    <a href="{{ route('projects.create') }}" class="btn btn-primary text-white ml-3">
                                        <i class="fas fa-plus"></i> Add New Project
                                    </a>

                                    <div class="card-header-form ml-auto">
                                        <form method="GET">
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                    placeholder="Search by Name or Email..." name="search"
                                                    value="{{ request('search') }}">
                                                <div class="input-group-btn ">
                                                    <button type="submit" class="btn btn-primary py-2"><i
                                                            class="fas fa-search"></i></button>
                                                </div>

                                               
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                {{-- Card Body: Table --}}
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 50px;">#</th>
                                                    <th>title</th>
                                                    <th>images</th>
                                                    <th>Attachment</th>
                                                    <th>Published BY</th>
                                                    <th>Registered</th>
                                                    <th>Status</th>
                                                    <th style="width: 150px;">Actions</th>
                                                </tr>

                                                {{--  --}}
                                            </thead>
                                            <tbody>
                                                 @forelse ($projects as $project)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $project->title }}</td>
                                                        {{-- Assuming a 'user' relationship or the auth_id points to a User model --}}
                                                     
                                                        
                                                        {{-- <td>{{ Str::limit($project->description, 20) }} ...</td> --}}
                                                        {{-- Format the date nicely for display --}}


                                                        {{-- @php
                                                          $images = $project->images;
                                                        @endphp
                                                        <td class="text-truncate">
                          <ul class="list-unstyled order-list m-b-0 m-b-0">
                            @forelse ( $images as $image)
                                <li class="team-member team-member-sm"><img class="rounded-circle" src="{{ asset("storage/".$image) }}" alt="user" data-toggle="tooltip" title="" data-original-title="{{ $project->name }}"></li>
                            @empty
                                
                            @endforelse --}}
                            
                          </ul>
                          <td><a href="{{ $project->attachment ? asset("storage/".$project->attachment): "#"}}" > {{ $project->attachment ?  "Download" :"" }}</a></td> 
                          <td>{{ $project->auth->name ?? 'N/A' }}</td> 
                         <td>{{ $project->status ?? 'N/A' }}</td> 
                        </td>
                                                        {{-- <td>{{ \Carbon\Carbon::parse($project->start_at)->format('M d, Y') }}</td>
                                                        <td>{{ $project->location }}</td> --}}
                                                        <td>{{ \Carbon\Carbon::parse($project->end_at)->format('M d, Y') }}</td>
                                                         <td>
                                                            {{-- Show Button --}}
                                                            <a href="{{ route('projects.show', $project->slug ?? 1) }}"
                                                                class="btn btn-info " title="View">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            {{-- Edit Button --}}
                                                            <a href="{{ route('projects.show', $project->slug ?? 1) }}"
                                                                class="btn btn-warning" data-toggle="tooltip"
                                                                title="Edit"><i class="fas fa-edit"></i></a>


                                                            <form
                                                                action="{{ route('projects.destroy', ['project' => $project->slug ?? 1]) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Are you sure you want to delete this project?')"
                                                                class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger"
                                                                    title="Delete">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                         </td>
                                             




                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">No projects found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                {{-- Card Footer: Pagination --}}
                                <div class="card-footer text-right">
                                    <nav class="d-inline-block">
                                        {{-- {{ $users->appends(['search' => request('search')])->links() }} --}}
                                        {{-- Added appends() to retain search filter during pagination --}}
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
         

    {{-- Script for Delete Confirmation --}}

            </section>
    @push('scripts')
        <script>
            document.querySelectorAll('.delete-user').forEach(button => {
                button.addprojectListener('click', function(project) {
                    const userId = this.getAttribute('data-id');
                    const form = document.getElementById(`delete-form-${userId}`);

                    if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
                        form.submit();
                    }
                });
            });
        </script>
    @endpush
@endsection
