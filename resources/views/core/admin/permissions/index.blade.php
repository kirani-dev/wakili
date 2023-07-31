@extends('layouts.dashboard')

@section('title') PermissionGroups @endsection
@section('bread_crumb')
    <li class="breadcrumb-item active" aria-current="page">PermissionGroups</li>
@endsection
@section('header_action')
        <a href="#permissiongroup_modal" class="btn btn-info btn-sm clear-form float-right" data-bs-toggle="modal"><i class="fa fa-plus"></i> ADD PERMISSIONGROUP</a>
@endsection
@section('content')

            <div class="card">
                <div class="card-body">
                    @include('common.bootstrap_table_ajax',[
                    'table_headers'=>["id","name","description","permissions","user_id","action"],
                    'data_url'=>'admin/permissions/list',
                    'base_tbl'=>'permissiongroups'
                    ])
                    @include('common.auto_modal',[
                        'modal_id'=>'permissiongroup_modal',
                        'modal_title'=>'PERMISSIONGROUP FORM',
                        'modal_content'=>autoForm(\App\Models\Core\PermissionGroup::class,"admin/permissions")
                    ])
                 </div>
             </div>

@endsection


