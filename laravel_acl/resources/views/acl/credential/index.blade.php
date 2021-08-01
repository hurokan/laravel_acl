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
                                    <h4>Menu Credential For: {{$rolaData->role_name}}</h4>
                                    <form id="hasMenuStore" action="{{route('credential.store-menu',$rolaData->id)}}" method="POST">
                                        @csrf
                                        <div class="col-12">
                                            <div class="table-responsive" style="max-height: 1105px;">
                                                <ul class="sidebar-menu permissionMenu" data-widget="tree">
                                                        @foreach (\App\Helper\HelperClass::menuList() as $menu)
                                                            @include('acl.credential.item', ['menu' => $menu, 'rolaData' => $rolaData ,  'selected'=> $rolaData->hasMenuPermission($menu['id'])])
                                                        @endforeach
                                                </ul>
                                                <!-- /.box-body -->
                                            </div>
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
            $(document).on('submit', '#hasMenuStore', function (e) {
                e.preventDefault();
                var val = [];
                let form_data = [];
                $('.menuCheck:checkbox:checked').each(function (i) {
                    var obj = {};
                    obj.menu_item_id = $(this).val();
                    form_data.push(obj);
                    val[i] = $(this).val();
                });
                let url = $(this).attr('action');
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
                        $.post(url, {data:form_data, "_token": "{{ csrf_token() }}"}, function (data){
                            if (data.success == true) {
                                console.log(data)
                                // let redirect_url = baseurl+'/'+data.order_ids;
                                // window.open(redirect_url, '_blank');
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
        $(".menuCheck").click(function () {
            // $('input:checkbox').not(this).prop('checked', this.checked);
            var ul = $(this).parent('li').find('ul');
            if ($(this).is(":checked")){
                ul.find('li input').attr('checked', 'checked');
                ul.show();
            } else {
                ul.find('li input').removeAttr('checked');
                ul.hide();
            }
        });
    </script>
@endsection
