<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Core\CategoryType;
use App\Repositories\SearchRepo;
use Illuminate\Support\Facades\Schema;

class CategoryTypesController extends Controller
{
            /**
         * return categorytype's index view
         */
    public function index(){
        return view($this->folder.'index',[

        ]);
    }

    /**
     * store categorytype
     */
    public function storeCategoryType(){
        request()->validate($this->getValidationFields());
        $data = \request()->all();
        if(!isset($data['user_id'])) {
            if (Schema::hasColumn('categorytypes', 'user_id'))
                $data['user_id'] = request()->user()->id;
        }

        $this->autoSaveModel($data);

        $action = \request('id') ? 'updated' : 'saved';
        return redirect()->back()->with('notice',['type'=>'success','message'=>'CategoryType '.$action.' successfully']);
    }

    /**
     * return categorytype values
     */
    public function listCategoryTypes(){
        $categorytypes = CategoryType::where([
            ['id','>',0]
        ]);
        if(\request('all'))
            return $categorytypes->get();
        return SearchRepo::of($categorytypes)
            ->addColumn('action',function($categorytype){
                $str = '';
                $json = json_encode($categorytype);
                $str.='<a href="#" data-model="'.htmlentities($json, ENT_QUOTES, 'UTF-8').'" onclick="prepareEdit(this,\'categorytype_modal\');" class="btn badge btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>';
            //    $str.='&nbsp;&nbsp;<a href="#" onclick="deleteItem(\''.url(request()->user()->role.'/categorytypes/delete').'\',\''.$categorytype->id.'\');" class="btn badge btn-outline-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>';
                return $str;
            })->make();
    }

    /**
     * delete categorytype
     */
    public function destroyCategoryType($categorytype_id)
    {
        $categorytype = CategoryType::findOrFail($categorytype_id);
        $categorytype->delete();
        return redirect()->back()->with('notice',['type'=>'success','message'=>'CategoryType deleted successfully']);
    }

}
