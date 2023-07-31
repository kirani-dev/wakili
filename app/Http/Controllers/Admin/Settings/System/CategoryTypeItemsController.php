<?php

namespace App\Http\Controllers\Admin\Settings\System;

use App\Http\Controllers\Controller;
use App\Models\Core\CategoryTypeItem;
use App\Repositories\SearchRepo;
use Illuminate\Support\Facades\Schema;

class CategoryTypeItemsController extends Controller
{
            /**
         * return categorytypeitem's index view
         */
    public function index(){
        return view($this->folder.'index',[

        ]);
    }

    /**
     * store categorytypeitem
     */
    public function storeCategoryTypeItem(){
        request()->validate($this->getValidationFields());
        $data = \request()->all();
        if(!isset($data['user_id'])) {
            if (Schema::hasColumn('categorytypeitems', 'user_id'))
                $data['user_id'] = request()->user()->id;
        }

        $this->autoSaveModel($data);

        $action = \request('id') ? 'updated' : 'saved';
        return redirect()->back()->with('notice',['type'=>'success','message'=>'CategoryTypeItem '.$action.' successfully']);
    }

    /**
     * return categorytypeitem values
     */
    public function listCategoryTypeItems(){
        $categorytypeitems = CategoryTypeItem::where([
            ['id','>',0]
        ]);
        if(\request('all'))
            return $categorytypeitems->get();
        return SearchRepo::of($categorytypeitems)
            ->addColumn('action',function($categorytypeitem){
                $str = '';
                $json = json_encode($categorytypeitem);
                $str.='<a href="#" data-model="'.htmlentities($json, ENT_QUOTES, 'UTF-8').'" onclick="prepareEdit(this,\'categorytypeitem_modal\');" class="btn badge btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>';
            //    $str.='&nbsp;&nbsp;<a href="#" onclick="deleteItem(\''.url(request()->user()->role.'/categorytypeitems/delete').'\',\''.$categorytypeitem->id.'\');" class="btn badge btn-outline-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>';
                return $str;
            })->make();
    }

    /**
     * delete categorytypeitem
     */
    public function destroyCategoryTypeItem($categorytypeitem_id)
    {
        $categorytypeitem = CategoryTypeItem::findOrFail($categorytypeitem_id);
        $categorytypeitem->delete();
        return redirect()->back()->with('notice',['type'=>'success','message'=>'CategoryTypeItem deleted successfully']);
    }

}
