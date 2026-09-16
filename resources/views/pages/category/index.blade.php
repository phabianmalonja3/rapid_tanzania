@extends('layouts.app')

<x-title>Category List</x-title>

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
                                <h4>Manage Categories</h4>
                                {{-- Link to the category creation form --}}
                                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle mr-1"></i> Create New Category
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
                                    <table class="table table-striped table-hover" id="categoriesTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($categories as $category)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $category->slug }}</td>
                                                    <td>
              
                                                        {{-- Edit Button --}}
                                                        <a href="{{ route('categories.edit', $category->slug) }}"
                                                           class="btn btn-warning" data-toggle="tooltip"
                                                           title="Edit"><i class="fas fa-edit"></i></a>

                                                        {{-- Delete Button --}}
                                                        <form action="{{ route('categories.destroy', $category->slug) }}"
                                                              method="POST"
                                                              onsubmit="return confirm('Are you sure you want to delete this category?')"
                                                              class="d-inline">
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
                                                    <td colspan="4" class="text-center">No categories found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                {{-- Optional: Pagination Links --}}
                                @if (isset($categories) && $categories instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                    <div class="card-footer text-right">
                                        {{ $categories->links() }}
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div> {{-- End row --}}

            </div>
        </section>
    </div>
</section>
@endsection
