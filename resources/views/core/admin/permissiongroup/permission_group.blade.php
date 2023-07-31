@extends('layouts.dashboard')

@section('bread_crumb')
    <span class="breadcrumb-item active">   Permission Group</span>
@endsection

@section('title') Permission Group @endsection

@section('content')
   <div class="row">
       <div class="col-md-4" >
           <div style="background-color: #d5e8fc; padding: 20px">
               <form class="form-horizontal" method="post" action="{{ url('admin/permissiongroup/update-permission/'.$permissionGroup->id) }}">
                   {{ csrf_field() }}
                   <div class="form-group">
                       <h4 class="control-label">Permissions</h4>
{{--                       <div class="form-row">--}}
                           @foreach($permissions->admin as $permission)
                               <div class="row">
                                   <div class="col-md-12">
                                       <input id="{{ $permission->slug }}" value="{{ $permission->slug }}" {{ @in_array($permission->slug,$existing) ? 'checked':'' }} type="checkbox" name="permissions[]">&nbsp;<label for="{{ $permission->slug }}">{{ ucwords(str_replace('_',' ',$permission->slug)) }}</label><br/>
                                   </div>
                                   <div class="col-md-12">
                                       <div style="padding-left: 20px!important;">
                                           @if($permission->type == 'many')
                                               @foreach($permission->children as $manyItem)
                                                   <div class="col-md-12">
                                                       <input data-parent="{{ $permission->slug }}"  id="{{ $manyItem->slug }}" value="{{ $manyItem->slug }}" {{ @in_array($manyItem->slug,$existing_menu_item_permissions) ? 'checked':'' }} type="checkbox" name="menu_item_permissions[]">
                                                       &nbsp;<label for="{{ $manyItem->slug }}">{{ $manyItem->label }}</label>
                                                       <br/>
                                                   </div>
                                               @endforeach

                                           @endif
                                       </div>
                                   </div>

                               </div>

                           @endforeach
{{--                       </div>--}}
                   </div>
                   <div class="form-group">
                       <button style="color: #fff;background-color: #ff943d; border-color: #ff943d;" type="submit" class="btn btn-info"><i class="fa fa-save"></i> Update</button>
                   </div>
               </form>
           </div>
       </div>

       <div class="col-md-8">
           <button type="button" class="btn btn-outline-primary waves-effect" data-bs-toggle="modal" data-bs-target=".addUserModal">Add User</button>
           <h4>Permission Group Users</h4>
            <div class="row">
                @foreach($usersWithPermissions as $user)
                    <div class="col-md-3">
                        {{ $user->full_name }} &nbsp;<span onclick="runPlainRequest('{{ url("admin/permissiongroup/remove/".$user->id) }}')" style="color: #f44336; cursor: pointer"><i class="fa fa-times"></i></span>
                    </div>
                @endforeach
            </div>
       </div>
   </div>
   <!-- Large modal button -->


   <!--  Large modal example -->
   <div class="modal fade addUserModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="myLargeModalLabel">
                       Add User to Permission Group
                   </h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <form method="post" action="{{ url('admin/permissiongroup/add-to-group/'.$permissionGroup->id) }}">
                       <div class="form-group">
                           <label>Select Users</label>
                               <select id="users" name="users" class="form-control">

                               </select>
                           @csrf
                       </div>
                       <input class="btn btn-secondary" type="submit" name="submit" value="Submit">
                   </form>
               </div>
           </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->



    <script>
        $(function () {


            autoFillSelect('users','{{ url('admin/permissiongroup/users/list') }}');

        })
    </script>

@endsection
