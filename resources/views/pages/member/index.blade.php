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

                                    <h4>Member's List</h4>

                                    <a href="{{ route('members.create') }}" class="btn btn-primary text-white ml-3">
                                        <i class="fas fa-plus"></i> Add New Member
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
                                                    <th>Position</th>
                                                    <th>profile</th>

                                                    
                                                    <th style="width: 150px;">Actions</th>
                                                </tr>

                                              @forelse ($members as $member)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $member->full_name }}</td>
                                                        {{-- Assuming a 'member' relationship or the auth_id points to a member model --}}
                                                        {{-- Format the date nicely for display --}}
                                                        <td>{{ \Carbon\Carbon::parse($member->start_at)->format('M d, Y') }}</td>
                
                                                        
                                                        <td><img src="{{ asset('storage/' . $member->image) }}" alt="" width="40" ></td>
                                                        
                                                         <td>
                                                            {{-- Show Button --}}
                                                            <a href="{{ route('members.show', $member->slug ?? 1) }}"
                                                                class="btn  btn-info " title="View">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            {{-- Edit Button --}}
                                                            <a href="{{ route('members.edit', $member->slug ?? 1) }}"
                                                                class="btn btn-warning" data-toggle="tooltip"
                                                                title="Edit"><i class="fas fa-edit"></i></a>


                                                            <form
                                                                action="{{ route('members.destroy', ['member' => $member->slug ?? 1]) }}"
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
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">No members found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                {{-- Card Footer: Pagination --}}
                                <div class="card-footer text-right">
                                    <nav class="d-inline-block">
                                        {{-- {{ $members->appends(['search' => request('search')])->links() }} --}}
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
            document.querySelectorAll('.delete-member').forEach(button => {
                button.addmemberListener('click', function(member) {
                    const memberId = this.getAttribute('data-id');
                    const form = document.getElementById(`delete-form-${memberId}`);

                    if (confirm('Are you sure you want to delete this member? This action cannot be undone.')) {
                        form.submit();
                    }
                });
            });
        </script>
    @endpush
@endsection
