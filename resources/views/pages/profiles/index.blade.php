@extends('layouts.app')

<x-title>Profile </x-title>
@section('main')
    <section class="section">
        <div class="container">
            <x-nav-bar />
            <x-side-bar />
        </div>

        <div class="main-content" style="min-height: 600px;">
            <section class="section">
                <div class="section-body">
                    <div class="row mt-sm-4">
                        <div class="col-12 col-md-12 col-lg-4">
                            <div class="card author-box">
                                <div class="card-body">
                                    <div class="author-box-center">
                                        <img alt="image"
                                            src="{{ auth()->user()->profile_img ? asset('storage/' . auth()->user()->profile_img) : asset('assets/img/no-profile.png') }}"
                                            class="rounded-circle author-box-picture">
                                        <div class="clearfix"></div>
                                        <div class="author-box-name">
                                            <a href="#">{{ auth()->user()->name }}</a>
                                        </div>

                                        <form action="{{ route('change-profile') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">

                                                <input type="file" class="form-control" name="profile">

   
                                            </div>

                                            @error('profile')
                                                        <div class="text-danger">{{ $message }}
                                                            
                                                        </div>
                                                        @enderror
                                            <div class="mt-1">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>

                                    </div>

                                </div>
                            </div>


                        </div>
                        <div class="col-6 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h1>Password Update</h1>
                                </div>
                                <div class="padding-20">
                                    <ul class="nav nav-tabs" id="myTab2" role="tablist">

                                    </ul>
                                    <div class="tab-content tab-bordered" id="myTab3Content">

                                        <form action="{{ route('change-password') }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-row">

                                                <div class="form-group col-md-12 mt-2">
                                                    <label for="inputPassword4">Current Password</label>
                                                    <input type="password" class="form-control" id="inputPassword4"
                                                        placeholder="Password" name="old_password">

                                                    @error('old_password')
                                                        <div class="text-danger">{{ $message }}

                                                        </div>
                                                        @enderror
                                                       
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword4">New Password</label>
                                                    <input type="password" class="form-control" 
                                                        placeholder="Password" name="password">
                                                    @error('password')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword4">Comfirm Password</label>
                                                    <input type="password" class="form-control" id="inputPassword4"
                                                        placeholder="Password" name="password_confirmation">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                                </div>
                                            </div>
                                        </form>

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