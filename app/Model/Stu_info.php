<?php

namespace App\Model;

use App\Http\Controllers\stuInfoController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Stu_info extends Model
{
    protected $table = "stu_info";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function StuinfoFind($stu_id){

        try {
            $data = self::where('stu_id', $stu_id)
                ->select('stu_id', 'stu_name', 'major', 'level')
                ->get();
            return $data;
        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function StuexpFind($exp,$stu_id){
        try {
            $data = DB::table($exp)
                ->select('sub_grade', 'obj_grade')
                ->where('stu_id', $stu_id)
                ->get();
            return $data;
        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
