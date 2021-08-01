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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Role</a></li>
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

                        <form class="form-horizontal" action="{{route('role.store_new_role')}}" method="post">
                            @csrf()
                            <input type="hidden" value="{{isset($role->id) ? $role->id : ''}}" name="role_id">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <label for="example-select">Role Name</label>
                                        <input type="text" id="role_name" name="role_name" value="{{$role->role_name}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <label for="example-select">Role Key</label>
                                        <input type="text" id="role_key" name="role_key" value="{{$role->role_key}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-2">
                                <div class="form-group mb-3">
                                    <label for="example-select">Grand Access</label>
                                    <select name="has_grand_access" id="has_grand_access" class="form-control">
                                        <option value="1" {{$role->is_enabled == 1 ? 'selected' : ''}}>Yes</option>
                                        <option value="0" {{$role->is_enabled == 0 ? 'selected' : ''}}>No</option>
                                    </select>
                                </div>
                            </div>
                                <div class="col-2">
                                    <div class="form-group mb-3">
                                        <label for="example-select">Status</label>
                                        <div class="ml-2 mt-2">
                                            <div class="radio radio-info form-check-inline preview-class color1">
                                                <input type="radio" id="inlieRadio1" value="1" name="is_enabled"  {{$role->is_enabled != 1 ? '' : 'checked'}}>
                                                <label for="inlineRadio1">Active</label>
                                            </div>
                                            <div class="radio radio-info form-check-inline preview-class color2">
                                                <input type="radio" id="inlineRadio2" value="0" name="is_enabled" {{$role->is_enabled == 0 ? 'checked' : ''}}>
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
                                <th>Role Name</th>
                                <th>Role Key</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @foreach($data as $role)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$role->role_name}}</td>
                                    <td>{{$role->role_key}}</td>
                                    <td>{{$role->is_enabled == '1' ? 'Active' : 'Inactive'}}</td>
                                    <td>
                                        <a class="btn btn-success waves-effect waves-light" href="{{route('role.edit-existing-role',$role->id)}}"><span class="fa fa-edit"></span></a>
                                         <form style="display: inline-block;" action="{{ route('menu.destroy-existing-menu', $role->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button  class="btn btn-danger" type="submit"><span class="fa fa-trash"></span></button>
                                        </form>
                                        <a class="btn btn-success waves-effect waves-light" href="{{route('credential.get-menu',$role->id)}}"><span class="glyphicon glyphicon-lock"></span>Menu Access</a>
                                        <a class="btn btn-success waves-effect waves-light" href="{{route('credential.get-permission',$role->id)}}"><span class="glyphicon glyphicon-wrench"></span>Permission Access</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
            <!-- Standard modal content -->
            <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form class="form-horizontal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="standard-modalLabel">Subject Assign</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="example-select">Class Name</label>
                                    <select class="form-control" id="example-select">
                                        <option>Class 1</option>
                                        <option>Class 2</option>
                                        <option>Class 3</option>
                                        <option>Class 4</option>
                                        <option>Class 5</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="example-select">Teachers</label>
                                    <select class="form-control" id="example-select">
                                        <option>Rahim</option>
                                        <option>Hossain</option>
                                        <option>Rokon</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="example-select">Subject</label>
                                    <select class="form-control" id="example-select">
                                        <option>Chemistry</option>
                                        <option>English</option>
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>

                        </div><!-- /.modal-content -->
                    </form>
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

        </div>
    </div>

@endsection

@section('script')

@endsection
