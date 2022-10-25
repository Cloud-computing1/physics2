<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class exp_ans4 extends Model
{
    //
    protected $remeberTokenName = NULL;
    protected $guarded = [];
    protected $fillable=[];
    protected $table="exp_ans4";
    public $timestamps =true;


    /**
     * 上传图片1
     * @param $OSS_url1
     * @param $stu_id
     * @return false
     */
    public static function expcreate1($OSS_url1,$stu_id)
    {try{
        $data =  self::where('stu_id','=',$stu_id)
            ->update([
                'OSS_url1'=>$OSS_url1,
            ]);
        return $data;
    }catch (\Exception $e) {
        logError("账号查询失败！", [$e->getMessage()]);
        return false;
    }
    }


    /**
     * 上传图片2
     * @param $OSS_url2
     * @param $stu_id
     * @return false
     */
    public static function expcreate2($OSS_url2,$stu_id)
    {try{
        $data =  self::where('stu_id','=',$stu_id)
            ->update([
                'OSS_url2'=>$OSS_url2,
            ]);
        return $data;
    }catch (\Exception $e) {
        logError("账号查询失败！", [$e->getMessage()]);
        return false;
    }

    }



    //欧姆表的安装与设计
    public static function Test4($a1,$a2,$a3,$b1,$b2,$b3,$b4,$b5,$b6,$b7,$b8,$c1,$c2,$c3,$d1,
                                 $d2,$d3,$obj_grade,$stu_id,$class){
        if ($a1 == 500.0){
            $obj_grade += 5;
        }else{
            $obj_grade += 0;
        }


        if ($a2 == 560.0){
            $obj_grade += 5;
        }else{
            $obj_grade += 0;
        }


        if ($a3 == 1.5){
            $obj_grade += 5;
        }else{
            $obj_grade += 0;
        }

        if ($b1 == 1.5){
            $obj_grade += 5;
        }else{
            $obj_grade += 0;
        }

        if ($b2 == 500.0){
            $obj_grade += 5;
        }else{
            $obj_grade += 0;
        }

        if ($b3 == 560.0){
            $obj_grade += 5;
        }else{
            $obj_grade += 0;
        }


        if ($b4 == 2440.0){
            $obj_grade += 5;
        }else{
            $obj_grade += 0;
        }


        if ($b5 == 1.5){
            $obj_grade += 5;
        }else{
            $obj_grade += 0;
        }


        if ($b6 == 2440.0){
            $obj_grade += 5;
        }else{
            $obj_grade += 0;
        }


        if ($b7 == 560.0){
            $obj_grade += 5;
        }else{
            $obj_grade += 0;
        }

        if ($b8 == 43.5){
            $obj_grade += 5;
        }else{
            $obj_grade += 0;
        }

        if ($c1<=2450 && $c1>=2390){
            $obj_grade += 5;
        }else{
            $obj_grade += 0;
        }


        if ($c2<=43 && $c2>=45){
            $obj_grade += 5;
        }else{
            $obj_grade += 0;
        }


        if ($c3<=20 && $c3>=275){
            $obj_grade += 5;
        }else{
            $obj_grade += 0;
        }

        if ($d1 == 'a' || $d1 == 'A'){
            $obj_grade += 5;
        }else{
            $obj_grade += 0;
        }


        if ($d2 == 'b' || $d2 == 'B'){
            $obj_grade += 5;
        }else{
            $obj_grade += 0;
        }


        if ($d3 == 'c' || $d3 == 'C'){
            $obj_grade += 5;
        }else{
            $obj_grade += 0;
        }


        DB::table('exp_4')->insert([
            'stu_id' => $stu_id,
            'class' => $class,
            'obj_grade' =>$obj_grade
        ]);
        self::create([
            'stu_id' => $stu_id,
            'a1' => $a1,
            'a2' => $a2,
            'a3' => $a3,
            'b1' => $b1,
            'b2' => $b2,
            'b3' => $b3,
            'b4' => $b4,
            'b5' => $b5,
            'b6' => $b6,
            'b7' => $b7,
            'b8' => $b8,
            'c1' => $c1,
            'c2' => $c2,
            'c3' => $c3,
            'd1' => $d1,
            'd2' => $d2,
            'd3' => $d3
        ]);

        return 1;
    }
}
