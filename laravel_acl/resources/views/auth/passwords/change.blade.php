@extends('layouts.dashboard')
@section('style')
@endsection
@section('content')
    <div class="container-fluid class-add">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Change Password</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Change Password</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    @if(Session::has('message'))
                                        <div class="alert {{ Session::get('m-class') }}show" role="alert">
                                            <strong> {{ Session::get('message') }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('store-change-password') }}">
                                        @csrf
                                        <input type="hidden" name="token" value="{{$auth->remember_token}}">
                                        <input type="hidden" name="user_id" value="{{$auth->id}}">
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">Name</label>
                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control" name="name"
                                                       value="{{$auth->name}}" readonly autocomplete="email" autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">User
                                                Name</label>
                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control" name="email"
                                                       value="{{$auth->email}}" readonly autocomplete="email" autofocus>
                                                @if ($errors->has('email'))
                                                    <span class="text-danger">{{$errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Password') }}<span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control"
                                                       name="password" required autocomplete="new-password">
                                                @if ($errors->has('password'))
                                                    <span class="text-danger">{{$errors->first('password') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password-confirm"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}<span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control"
                                                       name="password_confirmation" required
                                                       autocomplete="new-password">
                                                @if ($errors->has('password_confirmation'))
                                                    <span class="text-danger">{{$errors->first('password_confirmation') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Reset Password') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
