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

                                {{-- Card Header: Title, Add Button, and Search Bar (Combined for better UX) --}}
                                <div class="card-header">

                                    <h4>Users List</h4>

                                    <a href="{{ route('users.create') }}" class="btn btn-primary text-white ml-3">
                                        <i class="fas fa-plus"></i> Add New User
                                    </a>

                                    <div class="card-header-form ml-auto">
                                        <form method="GET">
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                    placeholder="Search by Name or Email..." name="search"
                                                    value="{{ request('search') }}">
                                                <div class="input-group-btn">
                                                    <button type="submit" class="btn btn-primary py-2"><i
                                                            class="fas fa-search"></i></button>
                                                </div>

                                                @if (request('search'))
                                                    <div class="input-group-btn">
                                                        <a href="{{ route('users.index') }}"
                                                            class="btn btn-secondary">Clear</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                {{-- Card Body: Table --}}
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <th style="width: 50px;">#</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Registered</th>
                                                    <th>Status</th>
                                                    <th style="width: 150px;">Actions</th>
                                                </tr>

                                                @forelse($users as $index => $user)
                                                    <tr>
                                                        <td class="p-0 text-center">{{ $users->firstItem() + $index }}</td>
                                                        <td>{{ $user->first_name }}</td>
                                                        <td class="align-middle">{{ $user->last_name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>
                                                            <div
                                                                class="badge badge-{{ $user->role === 'admin' ? 'danger' : 'success' }}">
                                                                {{ ucfirst($user->role ?? 'staff') }}
                                                            </div>
                                                        </td>
                                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                                        <td>
                                                            <div class="badge badge-success">Active</div>
                                                        </td>

                                                        <td>
    {{-- Show Button (always visible) --}}
    <a href="{{ route('users.show', $user->slug ?? 1) }}"
       class="btn btn-info" title="View">
        <i class="fas fa-eye"></i>
    </a>

    {{-- Edit Button --}}
    <a href="{{ route('users.show', $user->slug ?? 1) }}"
       class="btn btn-warning {{ $user->hasRole('admin') ? 'disabled' : '' }}"
       title="Edit">
       <i class="fas fa-edit"></i>
    </a>

    {{-- Delete Button --}}
    <form action="{{ route('users.destroy', ['user' => $user->slug ?? 1]) }}"
          method="POST"
          onsubmit="return {{ $user->hasRole('admin') ? 'false' : 'confirm(\'Are you sure you want to delete this event?\')' }}"
          class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="btn btn-danger {{ $user->hasRole('admin') ? 'disabled' : '' }}"
                title="Delete">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</td>

                                                   
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">
                                                            <p class="mt-3 text-muted">
                                                                @if (request('search'))
                                                                    No users found matching **"{{ request('search') }}"**.
                                                                    <a href="{{ route('users.index') }}">View all
                                                                        users</a>.
                                                                @else
                                                                    No users have been added yet.
                                                                @endif
                                                            </p>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                {{-- Card Footer: Pagination --}}
                                <div class="card-footer text-right">
                                    <nav class="d-inline-block">
                                        {{ $users->appends(['search' => request('search')])->links() }}
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
                button.addEventListener('click', function(event) {
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
