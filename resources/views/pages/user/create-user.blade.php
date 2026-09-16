@extends('layouts.app')

@php
    // Determine if we are creating or editing
    $isEdit = isset($user) && $user->exists;
    $formTitle = $isEdit ? 'Edit User' : 'Create New User';
    $formRoute = $isEdit ? route('users.update', $user->slug) : route('users.store');
    $formMethod = $isEdit ? 'POST' : 'POST'; // Use POST but include @method('PUT') below for updates
@endphp

<x-title>{{ $formTitle }}</x-title>

@section('main')
     <section class="section">
        <div class="container">
            <x-nav-bar />
            <x-side-bar />
        </div>

        <div class="main-content" style="min-height: 600px;">
            
                    <div class="row">
                        {{-- Centered Form Column --}}
                        <div class="col-md-12 col-lg-6 justify-center mx-auto">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4>{{ $formTitle }}</h4>
                                </div>
                                <div class="card-body">

                                    {{-- Random Password Alert (Only for Create) --}}
                                    @if (!$isEdit && session('password'))
                                        <div class="alert alert-info d-flex justify-content-between align-items-center">
                                            <div>
                                                Please make sure you save this Password: 
                                                <strong id="userPassword">{{ session('password') }}</strong>
                                            </div>
                                            <button class="btn btn-sm btn-outline-info ml-3" onclick="copyPassword(event)">
                                                <i class="fas fa-copy"></i> Copy
                                            </button>
                                        </div>
                                    @endif

                                    {{-- Form Start --}}
                                    <form action="{{ $formRoute }}" method="POST">
                                        @csrf
                                        @if ($isEdit)
                                            @method('PUT') {{-- Required for Update route --}}
                                        @endif

                                        {{-- 1. First Name --}}
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                                name="first_name" 
                                                value="{{ old('first_name', $user->first_name ?? '') }}" 
                                                required>
                                            @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        
                                        {{-- 2. Last Name --}}
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                                name="last_name" 
                                                value="{{ old('last_name', $user->last_name ?? '') }}" 
                                                required>
                                            @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        {{-- 3. Email --}}
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                name="email" 
                                                value="{{ old('email', $user->email ?? '') }}" 
                                                required>
                                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div> 
                                        
                                        {{-- 4. Roles --}}
                                       <div class="form-group">
    <label for="role-select">Roles</label>
    
    {{-- Use the official Blade @use directive for cleaner code --}}
    @use('Spatie\Permission\Models\Role','Role') 

    @php
        // Fetch and order roles for presentation
        $roles = Role::all(); 
        $currentRoleName = old('role', optional($user ?? null)->role ?? optional($user ?? null)->getRoleNames() ?? 'user');
    @endphp

    <select id="role-select" class="form-control @error('role') is-invalid @enderror" name="role" required>
        <option value="" disabled selected>Select a role...</option>
        @foreach ($roles as $role)
            {{-- CRITICAL FIX: Use $role->name for both the value and the selection check --}}
            <option 
                value="{{$role->name}}" 
                @if($currentRoleName == $role->name) selected @endif
            >
                {{ Str::title($role->name) }} {{-- Use Str::title for nicer display (e.g., 'super-admin' becomes 'Super Admin') --}}
            </option>
        @endforeach
    </select>
    @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
                                        
                                        {{-- Optional: Password Change Notice for Edit Mode --}}
                                        @if ($isEdit)
                                            <div class="alert alert-warning">
                                                To change the user's password, please use the dedicated password reset feature (or leave password fields blank if not changing).
                                            </div>
                                        @endif
                                        
                                </div> {{-- End card-body --}}

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">{{ $isEdit ? 'Update User' : 'Create User' }}</button>
                                    <button class="btn btn-secondary" type="reset">Reset</button>
                                </div>
                                </form>

                            </div> {{-- End card --}}
                        </div> {{-- End col --}}
                    </div> {{-- End row --}}

                </div> {{-- End section-body --}}
       
      
     </section>

    


                @endsection

@pushOnce('scripts')
<script>
    window.copyPassword = function (e) {
        e.preventDefault();

        const passwordText = document.getElementById("userPassword")?.innerText;

        if (!passwordText) {
            iziToast.warning({
                title: 'No Password',
                message: 'No password found to copy!',
                position: 'topRight'
            });
            return;
        }

        const btn = e.currentTarget;

        navigator.clipboard.writeText(passwordText)
            .then(() => {

                // Change the inner icon + text
                btn.innerHTML = `<i class="fas fa-check"></i> Copied`;

                // Restore original icon + text
                setTimeout(() => {
                    btn.innerHTML = `<i class="fas fa-copy"></i> Copy`;
                }, 2000);

                // Toast success
                iziToast.success({
                    title: 'Success',
                    message: 'Password copied to clipboard!',
                    position: 'topRight'
                });
            })
            .catch((err) => {

                iziToast.error({
                    title: 'Copy Failed',
                    message: `Error: ${err}`,
                    position: 'topRight'
                });

            });
    }
</script>
@endPushOnce
