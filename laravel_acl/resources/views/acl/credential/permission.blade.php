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
                    <h4 class="page-title">Permission Assigned For :{{$roleData->role_name}}</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="box-header with-border" style="background-color: #ecf0f5;">
                                        <h5 class="text-center text-bold">
                                            <input class="permissionCheck1" type="checkbox" name="role_id" id="checkAll" value="{{$roleData->id}}" > &nbsp;<span style="position: relative;top: -2px">Role Name: {{$roleData->role_name}}</span></h5>
                                    </div>
                                        <form id="hasPermissionStore" action="{{route('credential.store-permission',$roleData->id)}}" method="POST">
                                            @csrf
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered permission-table">
                                                        <tbody>
                                                        @foreach($menus[0]->menus as $menu)
                                                            <tr>
                                                                <th style="width: 15%;background-color: #c8ebffb0">{{$menu->menu_name}}</th>
                                                                @php
                                                                    $permission_items= \App\Models\Acl\Permission::where('menu_id',$menu->id)->whereIn('menu_id', array_keys($roleMenus))->get();
                                                                @endphp
                                                                <td class="report-permissions" colspan="5">
                                                                    @foreach($permission_items as $val)
                                                                        <span style="float: left">
                                                		<div aria-checked="false" aria-disabled="false">
                                                            <div class="checkbox">
                                                				<input type="checkbox" class="permissionCheck"
                                                                       value="{{$val->id}}"
                                                                       id="permission_id_{{$val->id}}"
                                                                       @if (in_array($val->id,$selectedPermission))  checked
                                                                       @endif name="permission_id[]">
                                                				 <label for="permission_id_{{$val->id}}"
                                                                        class="padding05">{{$val->permission_name}} &nbsp;&nbsp;</label>
                                                            </div>
                                                		</div>
                                                	</span>
                                                                    @endforeach
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-12">
                                                    <div class="col-md-offset-5 col-md-7">
                                                        <button type="submit" name="save" id="save"
                                                                class="btn btn-success  margin"><i
                                                                    class="fa fa-credit-card"></i> Save
                                                        </button>
                                                        <a href="{{route('role.index')}}" class="btn btn-danger margin"><i
                                                                    class="fa fa-arrow-left"></i>
                                                            Back </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                </div>  <!-- end card-body -->
                            </div>  <!-- end card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('submit', '#hasPermissionStore', function (e) {
                console.log('e');
                e.preventDefault();
                var val = [];
                let form_data = [];
                $('.permissionCheck:checkbox:checked').each(function (i) {
                    var obj = {};
                    obj.permission_item_id = $(this).val();
                    form_data.push(obj);
                    console.log('obj',obj);
                    val[i] = $(this).val();
                });

                // if (val.length <= 0) {
                //     alert('Please Check Box Click');
                //     return;
                // }

                let url = $(this).attr('action');
                {{--var baseurl = '{{route('invoice-process',['order_id'=>''])}}';--}}
                swal({
                    title: "Are you sure?",
                    text: "",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, submit it!",
                    confirmButtonClass: "btn btn-primary",
                    cancelButtonClass: "btn btn-danger ml-1",
                    buttonsStyling: !1
                }).then(function (e) {
                    if (e.value === true) {
                        // console.log(form_data);
                        // return;
                        $.post(url, {data:form_data, "_token": "{{ csrf_token() }}"}, function (data){
                            if (data.success == true) {
                                swal("Success!", data.message, "success");
                            } else {
                                swal("Error!", data.message, "error");
                            }
                        });
                    } else {
                        e.dismiss;
                    }

                }, function (dismiss) {
                    return false;
                })
            })

        });
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection
