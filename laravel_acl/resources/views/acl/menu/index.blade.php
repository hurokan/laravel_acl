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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Menu</a></li>
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

                        <form class="form-horizontal" action="{{route('menu.menu-new-menu')}}" method="post">
                            @csrf()
                            <input type="hidden" value="{{isset($menu->id) ? $menu->id : ''}}" name="menu_id">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <label for="example-select">Menu Name</label>
                                        <input type="text" id="menu_name" name="menu_name" value="{{old('url',$menu->menu_name)}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <label for="example-select">Menu icon</label>
                                        <input type="text" id="menu_icon" name="menu_icon" value="{{old('url',$menu->menu_icon)}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <label for="example-select">Menu Url</label>
                                        <input type="text" id="url" name="url" value="{{old('url',$menu->url)}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <label for="example-select">Route Name</label>
                                        <input type="text" id="route_name" name="route_name" value="{{old('url',$menu->route_name)}}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <label for="example-select">Parent Menu</label>
                                        <select name="parent_menu_id" id="parent_menu_id" class="form-control">>
                                            <option value="">Select One</option>
                                            @foreach($data as $value)
                                                <option value="{{$value->id}}" {{$value->id == $menu->id ? 'selected' : ''}}>{{$value->menu_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <label for="example-select">Sort Order</label>
                                        <input type="text" id="sort_order" name="sort_order" value="{{old('url',$menu->sort_order)}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <label for="example-select">Status</label>
                                        <div class="ml-2 mt-2">
                                            <div class="radio radio-info form-check-inline preview-class color1">
                                                <input type="radio" id="inlieRadio1" value="1" name="is_enabled" {{$menu->is_enabled == 1 ? 'checked' : ''}}>
                                                <label for="inlineRadio1">Active</label>
                                            </div>
                                            <div class="radio radio-info form-check-inline preview-class color2">
                                                <input type="radio" id="inlineRadio2" value="0" name="is_enabled" {{$menu->is_enabled != 1 ? 'checked' : ''}}>
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
                                <th>Menu Name</th>
                                <th>Url</th>
                                <th>Menu Route</th>
                                <th>Parent Menu</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @foreach($data as $menu)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$menu->menu_name}}</td>
                                    <td>{{$menu->url}}</td>
                                    <td>{{$menu->route_name}}</td>
                                    <td>{{$menu->parent_menu_id}}</td>
                                    <td>{{$menu->is_enabled == '1' ? 'Active' : 'Inactive'}}</td>
                                    <td>
                                        <a class="btn btn-success waves-effect waves-light" href="{{route('menu.edit-existing-menu', $menu->id)}}"><span class="fa fa-edit"></span></a>
                                        <form style="display: inline-block;" action="{{ route('menu.destroy-existing-menu', $menu->id)}}" method="post">
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
