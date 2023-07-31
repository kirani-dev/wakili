<div class="card">
    <div class="card-body">
        <a href="#categorytype_modal" class="btn btn-info btn-sm clear-form float-right" data-bs-toggle="modal"><i class="fa fa-plus"></i> ADD CATEGORY TYPE</a>

        @include('common.bootstrap_table_ajax',[
        'table_headers'=>["name","description","action"],
        'data_url'=>'admin/settings/system/categorytypes/list',
        'base_tbl'=>'category_types'
        ])
        @include('common.auto_modal',[
            'modal_id'=>'categorytype_modal',
            'modal_title'=>'CATEGORY TYPE FORM',
            'modal_content'=>autoForm(["name","description","form_model"=>\App\Models\Core\CategoryType::class],"admin/settings/system/categorytypes")
        ])
     </div>
 </div>



