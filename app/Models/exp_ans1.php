<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class exp_ans1 extends Model
{
    use Notifiable;

    protected $table = 'exp_ans1';
    protected $remeberTokenName = NULL;
    protected $guarded = [];
    protected $fillable=[];
    //


    /**
     * 将URL和学号添加到数据库
     * @param $OSS_url
     * @param $stu_id
     * @return mixed
     */
    public static function expcreate($OSS_url,$stu_id)
    {try{
        $data =  self::where('stu_id','=',$stu_id)
            ->update([
                'OSS_url'=>$OSS_url,
            ]);
        return $data;
    }catch (\Exception $e) {
        logError("账号查询失败！", [$e->getMessage()]);
        return false;
    }

    }



    /**
     * 将重力加速度的学生答案传进去，并算分
     * @param $a1
     * @param $b1
     * @param $b2
     * @param $b3
     * @param $b4
     * @param $b5
     * @param $b6
     * @param $b7
     * @param $b8
     * @param $b9
     * @param $b10
     * @param $b11
     * @param $b12
     * @param $b13
     * @param $b14
     * @param $b15
     * @param $b16
     * @param $b17
     * @param $d1
     * @param $d2
     * @param $d3
     * @param $stu_id
     * @param $obj_grade
     * @param $class
     * @return int
     */
    public static function tcreate($a1,$b1,$b2,$b3,$b4,$b5,$b6,$b7,$b8,$b9,$b10,$b11,$b12,$b13,$b14,$b15,$b16,$b17,$d1,$d2,$d3,$stu_id,$obj_grade,$class)
    {
        if($a1 == 1.967){
            $obj_grade =$obj_grade + 5;
        }else{
            $obj_grade =$obj_grade + 0;
        }

        if($b1 == 1.662){
            $obj_grade =$obj_grade + 3;
        }else{
            $obj_grade =$obj_grade + 0;
        }

        if($b2 == 1.702){
            $obj_grade =$obj_grade + 5;
        }else{
            $obj_grade =$obj_grade + 0;
        }

        if($b3 == 1.672){
            $obj_grade =$obj_grade + 3;
        }else{
            $obj_grade =$obj_grade + 0;
        }

        if($b4 == 1.672){
            $obj_grade =$obj_grade + 3;
        }else{
            $obj_grade =$obj_grade + 0;
        }

        if($b5 == 1.692){
            $obj_grade =$obj_grade + 3;
        }else{
            $obj_grade =$obj_grade + 0;
        }

        if($b6 == 1.721){
            $obj_grade =$obj_grade + 3;
        }else{
            $obj_grade =$obj_grade + 0;
        }

        if($b7 == 1.687){
            $obj_grade =$obj_grade + 3;
        }else{
            $obj_grade =$obj_grade + 0;
        }

        if($b8 == 0.025){
            $obj_grade =$obj_grade + 3;
        }else{
            $obj_grade =$obj_grade + 0;
        }

        if($b9 == 0.015){
            $obj_grade =$obj_grade + 3;
        }else{
            $obj_grade =$obj_grade + 0;
        }

        if($b10 == 0.015){
            $obj_grade =$obj_grade + 3;
        }else{
            $obj_grade =$obj_grade + 0;
        }

        if($b11 == 0.015){
            $obj_grade =$obj_grade + 3;
        }else{
            $obj_grade =$obj_grade + 0;
        }

        if($b12 == 0.005){
            $obj_grade =$obj_grade + 3;
        }else{
            $obj_grade =$obj_grade + 0;
        }

        if($b13 == 0.034){
            $obj_grade =$obj_grade + 3;
        }else{
            $obj_grade =$obj_grade + 0;
        }

        if($b14 == 0.018){
            $obj_grade =$obj_grade + 3;
        }else{
            $obj_grade =$obj_grade + 0;
        }


        if($b15 == 1.687){
            $obj_grade =$obj_grade + 2;
        }else{
            $obj_grade =$obj_grade + 0;
        }

        if($b16 == 0.018){
            $obj_grade =$obj_grade + 2;
        }else{
            $obj_grade =$obj_grade + 0;
        }

        if($b17 == 91.78){
            $obj_grade =$obj_grade + 5;
        }else{
            $obj_grade =$obj_grade + 0;
        }

        if($d1 == 'C' || $d1 == 'c'){
            $obj_grade =$obj_grade + 5;
        }else{
            $obj_grade =$obj_grade + 0;
        }

        if($d2 == 'C' || $d1 == 'c'){
            $obj_grade =$obj_grade + 5;
        }else{
            $obj_grade =$obj_grade + 0;
        }

        if($d3 == 'A' || $d1 == 'a'){
            $obj_grade =$obj_grade + 5;
        }else{
            $obj_grade =$obj_grade + 0;
        }
        DB::table('exp_1')->insert([
            'stu_id' => $stu_id,
            'class' => $class,
            'obj_grade' =>$obj_grade
        ]);


            self::create([
             'stu_id' => $stu_id,
            'a1'=>$a1,
            'b1' => $b1,
            'b2' => $b2,
            'b3' => $b3,
            'b4' => $b4,
            'b5' => $b5,
            'b6' => $b6,
            'b7' => $b7,
            'b8' => $b8,
            'b9' => $b9,
            'b10' => $b10,
            'b11' => $b11,
            'b12' => $b12,
            'b13' => $b13,
            'b14' => $b14,
            'b15' => $b15,
            'b16' => $b16,
            'b17' => $b7,
            'd1' => $d1,
            'd2' => $d2,
            'd3' => $d3,
        ]);
        return $obj_grade;
    }


    /**
     * 判断学生是否是第一次答题
     * @param $stu_id
     * @return false
     */
    public static function checknumber2($stu_id)
    {
        try{
            $cunt = exp_ans1::select('stu_id')
                ->where('stu_id',$stu_id)
                ->count();
            return $cunt;
        }catch (\Exception $e) {
            logError("账号查询失败！", [$e->getMessage()]);
            return false;
        }
    }
}
