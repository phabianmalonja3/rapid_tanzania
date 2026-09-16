@extends('layouts.app')

<x-title>All positions</x-title>

@section('main')
    <section class="section">
        <div class="container">
            {{-- Assuming standard dashboard components like nav-bar and side-bar exist --}}
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
                                    <h4>positionion Lists</h4>
                                    {{-- Link to the position creation form --}}
                                    <a href="{{ route('positions.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus-circle mr-1"></i> Create New position
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
                                        <table class="table table-striped table-hover" id="positionsTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Created At</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- Check if $positions variable exists and is iterable --}}
                                                @forelse($positions as $position)
                                                   <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $position->name }}</td>
                                                        {{-- Assuming a 'user' relationship or the auth_id points to a User model --}}
                                                     
                                                       
                                                        <td>{{ Str::limit($position->description, 20) }} ...</td>
                                                        {{-- Format the date nicely for display --}}
                                                        <td>{{ \Carbon\Carbon::parse($position->start_at)->format('M d, Y') }}</td>
                                                         <td>
                                                            {{-- Show Button --}}
                                                            <a href="{{ route('positions.show', $position->slug ?? 1) }}"
                                                                class="btn btn-info " title="View">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            {{-- Edit Button --}}
                                                            <a href="{{ route('positions.show', $position->slug ?? 1) }}"
                                                                class="btn btn-warning" data-toggle="tooltip"
                                                                title="Edit"><i class="fas fa-edit"></i></a>


                                                            <form
                                                                action="{{ route('positions.destroy', ['position' => $position->slug ?? 1]) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Are you sure you want to delete this position?')"
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
                                                        <td colspan="7" class="text-center">No positions found. <a href="{{ route('positions.create') }}">Start writing one!</a></td>
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
    document.addpositionListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addpositionListener('click', function(e) {
                e.prpositionDefault();
                const positionId = this.getAttribute('data-id');
                
                // --- CUSTOM CONFIRMATION LOGIC GOES HERE ---
                // For demonstration, we'll use a console log, but in a real app,
                // you would display a Bootstrap/Tailwind modal here asking for confirmation.
                
                console.log(`Confirm deletion for position ID: ${positionId}. Replacing window.confirm() with custom UI.`);
                
                // If confirmed (via your custom modal logic):
                // document.getElementById(`delete-form-${positionId}`).submit();

                // Placeholder for simple execution (REMOVE THIS IN PRODUCTION!)
                if (confirm('Are you sure you want to delete this position? (Requires custom modal in production)')) {
                    document.getElementById(`delete-form-${positionId}`).submit();
                }
            });
        });
    });
</script>
@endpush