@extends('layouts.dashboard')

@section('breadcrumb')
    <nav class="d-none d-md-block" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('admin') }}">Dashboard</a>
            </li>

            <li class="breadcrumb-item active" aria-current="page">Manage Permissions</li>
        </ol>
    </nav>
@endsection

@section('title') PermissionGroups @endsection

@section('content')
<a href="#permissiongroup_modal" class="btn btn-info btn-sm clear-form float-right" data-bs-toggle="modal"><i class="fa fa-plus"></i> ADD PERMISSIONGROUP</a>
    @include('common.bootstrap_table_ajax',[
    'table_headers'=>["name","description","permissions","action"],
    'data_url'=>'admin/permissiongroup/list',
    'base_tbl'=>'permission_groups'
    ])

    @include('common.auto_modal',[
        'modal_id'=>'permissiongroup_modal',
        'modal_title'=>'PERMISSIONGROUP FORM',
        'modal_content'=>autoForm(\App\Models\Core\PermissionGroup::class,"admin/permissiongroup")
    ])


@include('common.auto_modal',[
     'modal_id'=>'permissions_modal',
     'modal_title'=>'Edit Department Permissions',
     'modal_content'=>'<div class="permissions_section"></div>'
 ])
{{--<script type="text/javascript">--}}
{{--    function getDepartmentPermission(id){--}}
{{--        ajaxLoad('{{ url("admin/departments/permissions") }}/'+id,'permissions_section');--}}
{{--    }--}}
{{--</script>--}}

@endsection


