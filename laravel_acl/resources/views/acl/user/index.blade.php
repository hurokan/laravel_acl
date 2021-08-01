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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                            <li class="breadcrumb-item active">{{$title}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{$title}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if(Session::has('message'))
                            <div class="alert {{ Session::get('m-class') }}    show" role="alert">
                                <strong> {{ Session::get('message') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <h4 class="mb-3 header-title">{{$title}}</h4>

                        <form class="form-horizontal" action="{{route('user.store-new-user')}}" method="post">
                            @csrf()
                            <input type="hidden" value="{{isset($user->id) ? $user->id : ''}}" name="user_id">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <label for="name">Full Name<span class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" required value="{{old('name',$user->name)}}" class="form-control">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{$errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <label for="email">Email<span class="text-danger">*</span></label>
                                        <input type="email" id="email" name="email"  class="form-control"  required value="{{old('email',$user->email)}}" autocomplete="off">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{$errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <label for="mobile_no">Mobile</label>
                                        <input type="text" id="mobile_no" name="mobile_no" value="{{old('mobile_no',$user->mobile_no)}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <label for="email">Contact Address</label>
                                        <input type="text" id="contact_address" name="contact_address" value="{{old('contact_address',$user->contact_address)}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <label for="password">Password<span class="text-danger">*</span></label>
                                        <input type="password" id="password" name="password" required value="{{old('password',$user->password)}}" autocomplete="off" class="form-control">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{$errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <label for="example-select">Confirm password<span class="text-danger">*</span></label>
                                        <input type="password" id="password_confirmation" name="password_confirmation" required value="{{old('password_confirmation',$user->password)}}" autocomplete="off" class="form-control">
                                        @if ($errors->has('password_confirmation'))
                                            <span class="text-danger">{{$errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <label for="role_id">Role<span class="text-danger">*</span></label>
                                        <select name="role_id" id="role_id" class="form-control" required>
                                            <option value="">Select One</option>
                                            @foreach($role as $value)
                                                <option value="{{$value->id}}"@if($user->role_id ==$value->id || old('role_id')==$value->id) selected="selected" @endif>{{$value->role_name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('role_id'))
                                            <span class="text-danger">{{$errors->first('role_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <label for="example-select">Status</label>
                                        <div class="ml-2 mt-2">
                                            <div class="radio radio-info form-check-inline preview-class color1">
                                                <input type="radio" id="inlieRadio1" value="1" name="is_active" {{$user->is_active == 1 ? 'checked' : ''}}>
                                                <label for="inlineRadio1">Active</label>
                                            </div>
                                            <div class="radio radio-info form-check-inline preview-class color2">
                                                <input type="radio" id="inlineRadio2" value="0" name="is_active" {{$user->is_active != 1 ? 'checked' : ''}}>
                                                <label for="inlineRadio2"> Inactive </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2" style="margin-top: 27px">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">{{$btn_name}}</button>
                                </div>
                            </div>


                        </form>

                    </div>  <!-- end card-body -->
                </div>  <!-- end card -->
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">

                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Full Name</th>
                                <th>User Name</th>
                                <th>Mobile</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @foreach($data as $user)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->mobile_no}}</td>
                                    <td>{{$user->role->role_name}}</td>
                                    <td>{{$user->is_active == '1' ? 'Active' : 'Inactive'}}</td>
                                    <td>
                                        <a class="btn btn-success waves-effect waves-light" href="{{route('user.edit-existing-user', $user->id)}}"><span class="fa fa-edit"></span></a>
                                        <form style="display: inline-block;" action="{{ route('user.destroy-existing-user', $user->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button  class="btn btn-danger" type="submit"><span class="fa fa-trash"></span></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
            <!-- Standard modal content -->
        </div>
    </div>

@endsection

@section('script')

@endsection
