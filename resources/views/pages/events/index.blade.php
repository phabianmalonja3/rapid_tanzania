@extends('layouts.app')

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
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4>Manage Events</h4>
                                    {{-- Link to the event creation form --}}
                                    <a href="{{ route('events.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus-circle mr-1"></i> Create New Event
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
                                        {{-- Updated table ID to eventsTable --}}
                                        <table class="table table-striped table-hover" id="eventsTable"> 
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Author</th>
                                                    <th>Description</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Location</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- Check if $events variable exists and is iterable --}}
                                                @forelse ($events as $event)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $event->name }}</td>
                                                        {{-- Assuming a 'user' relationship or the auth_id points to a User model --}}
                                                     
                                                        <td>{{ $event->user->name ?? 'N/A' }}</td> 
                                                        <td>{{ Str::limit($event->description, 20) }} ...</td>
                                                        {{-- Format the date nicely for display --}}
                                                        <td>{{ \Carbon\Carbon::parse($event->start_at)->format('M d, Y') }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($event->end_at)->format('M d, Y') }}</td>
                                                        <td>{{ $event->location }}</td>
                                                         <td>
                                                            {{-- Show Button --}}
                                                            <a href="{{ route('events.show', $event->slug ?? 1) }}"
                                                                class="btn btn-info " title="View">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            {{-- Edit Button --}}
                                                            <a href="{{ route('events.show', $event->slug ?? 1) }}"
                                                                class="btn btn-warning" data-toggle="tooltip"
                                                                title="Edit"><i class="fas fa-edit"></i></a>


                                                            <form
                                                                action="{{ route('events.destroy', ['event' => $event->slug ?? 1]) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Are you sure you want to delete this event?')"
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
                                                        <td colspan="8" class="text-center">No events found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    {{-- Optional: Pagination Links --}}
                                    @if (isset($events) && $events instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                        <div class="card-footer text-right">
                                            {{ $events->links() }}
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div> {{-- End row --}}

                </div>
        
@endsection