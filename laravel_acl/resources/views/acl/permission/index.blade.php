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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Permission</a></li>
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
                        <form class="form-horizontal" action="{{route('permission.store-new-permission')}}"
                              method="post">
                            @csrf()
                            <input type="hidden" value="{{isset($permission->id) ? $permission->id : ''}}"
                                   name="permission_id">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <label for="example-select">Role Name</label>
                                        <input type="text" id="permission_name" name="permission_name"
                                               value="{{isset($permission->permission_name)?$permission->permission_name:''}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <label for="example-select">Permission Key</label>
                                        <input type="text" id="permission_key" name="permission_key"
                                               value="{{isset($permission->permission_key)?$permission->permission_key:''}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <label for="example-select">Status</label>
                                        <div class="ml-2 mt-2">
                                            <div class="radio radio-info form-check-inline preview-class color1">
                                                <input type="radio" id="inlieRadio1" value="1"
                                                       name="is_enabled" {{$permission->is_enabled != 1 ? '' : 'checked'}}>
                                                <label for="inlineRadio1">Active</label>
                                            </div>
                                            <div class="radio radio-info form-check-inline preview-class color2">
                                                <input type="radio" id="inlineRadio2" value="0"
                                                       name="is_enabled" {{$permission->is_enabled == 0 ? 'checked' : ''}}>
                                                <label for="inlineRadio2"> Inactive </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3" style="margin-top: 27px">
                                    <button type="submit"
                                            class="btn btn-primary waves-effect waves-light">{{$btn_name}}</button>
                                </div>
                            </div>
                        </form>
                    </div>

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
                            <th>Name</th>
                            <th>Key</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($data as $permission)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$permission->permission_name}}</td>
                                <td>{{$permission->permission_key}}</td>
                                <td>{{$permission->is_enabled == '1' ? 'Active' : 'Inactive'}}</td>
                                <td>
                                    <a class="btn btn-success waves-effect waves-light"
                                       href="{{route('permission.edit-existing-permission',$permission->id)}}"><span
                                                class="fa fa-edit"></span></a>
                                    <form style="display: inline-block;"
                                          action="{{ route('permission.destroy-existing-permission', $permission->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit"><span class="fa fa-trash"></span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    </div>

@endsection

@section('script')

@endsection
