@extends('layouts.app')

<x-title>Clients List</x-title>
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

                                    <h4>Client List</h4>

                                    <a href="{{ route('clients.create') }}" class="btn btn-primary text-white ml-3">
                                        <i class="fas fa-plus"></i> Add New Client
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
                                            <tbody>
                                                <tr>
                                                    <th style="width: 50px;">#</th>
                                                    <th>Client Name</th>
                                                    <th>Profile</th>
                                                    <th>Registered Date</th>
                                                    <th style="width: 150px;">Actions</th>
                                                </tr>
                                                @forelse ($clients as $client)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $client->name }}</td>
                
                                                   
                                                        <td><img src="{{asset('storage/'.$client->profile) }}"
                                                            alt="" width="40"></td>
                                                            
                                                            <td>{{ $client->created_at }}</td>
                                                        <td>
                                                            {{-- Show Button --}}
                                                            <a href="{{ route('clients.show', $client->id) }}"
                                                                class="btn btn-info " title="View">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            {{-- Edit Button --}}
                                                            <a href="{{ route('clients.edit', $client->id) }}"
                                                                class="btn btn-warning" data-toggle="tooltip"
                                                                title="Edit"><i class="fa fa-pencil-alt"></i></a>


                                                            <form
                                                                action="{{ route('clients.destroy', ['client' => $client->id]) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Are you sure you want to delete this client?')"
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
                                                        <td colspan="8" class="text-center">No clients found.</td>
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
            </section>
        </div>
    </section>

    {{-- Script for Delete Confirmation --}}
    @push('scripts')
        <script>
            document.querySelectorAll('.delete-user').forEach(button => {
                button.addEventListener('click', function(client) {
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
