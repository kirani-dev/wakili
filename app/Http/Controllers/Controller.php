<?php

namespace App\Http\Controllers;

use App\Models\Core\Log;
use App\Models\Core\LogType;
use App\Repositories\ModelSaverRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $class = get_class($this);

        $class = str_replace('App\\Http\\Controllers\\', "", $class);

        $arr = explode('\\', $class);
        unset($arr[count($arr) - 1]);
        $folder = implode('.', $arr) . '.';
        $this->folder = 'core.' . strtolower($folder);

    }

    function saveModel($data)
    {
        $model_saver = new ModelSaverRepository();
        $model = $model_saver->saveModel($data);
        return $model;
    }


    function autoSaveModel($data)
    {
        $model_saver = new ModelSaverRepository();
        $model = $model_saver->saveModel($data);
        return $model;
    }


    function getValidationFields($fillables = null)
    {
        $data = request()->all();
        if (!$fillables) {
            $model = new $data['form_model']();
            $fillables = $model->getFillable();
        }

        $validation_array = [];
        foreach ($fillables as $field) {
            $validation_array[$field] = 'required';
        }
        if (in_array("serial_number", $fillables)) {
            $validation_array['serial_number'] = 'required|unique:spare_parts,serial_number,'. \request('id'); // so that edit wont validate as true
        }

        if (in_array("LPO_number", $fillables)) {
            $validation_array['LPO_number'] = 'required|unique:lpos,number';
        }
        if (in_array("service_number", $fillables)) {
            $validation_array['service_number'] = 'required|unique:users,service_number';
        }
        if (in_array("username", $fillables)) {
            $validation_array['username'] = 'required|unique:users,username';
        }

        if (in_array("file", $fillables)) {
            $validation_array['file'] = 'required|max:50000';
        }
        $validation_array['id'] = '';
        $validation_array['form_model'] = '';
        return $validation_array;
    }

    public function bytesToHuman($bytes)
    {
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function logActivity($slug){
        $logType = LogType::where('slug',$slug)->first();
        if ($logType){
            $log = new Log();
            $log->log_type_id = $logType->id;
            $log->user_id =auth()->id();
            $log->save();

        }
    }
}
