<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class exp_ans3 extends Model
{
    //
    use Notifiable;


    protected $remeberTokenName = NULL;
    protected $guarded = [];
    protected $fillable=[];
    protected $table="exp_ans3";
    protected $primaryKey="stu_id";
    public $timestamps =true;


    /**
     * 上传图片
     * @param $OSS_url
     * @param $stu_id
     * @return false
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
    public static function checknumber3($stu_id)
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


    //获取自组式直流电桥测电阻
    public static function Test3($a1,$a2,$a3,$a4,$a5,$a6,$a7,$b1,$b2,$b3,$b4,$b5,$b6,$b7,$b8,$b9,$b10,
                                 $c1,$c2,$c3,$c4,$c5,$c6,$c7,$d1,$d2,$d3,$d4,$d5,$d6,$d7,
                                 $d8,$d9,$d10,$e1,$e2,$e3,$e4,$obj_grade,$stu_id,$class,$data){
        if ( 100<=$a1 && $a1<=999 ){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }

        if (100<=$a2 && $a2<=999){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }


        if (100<=$a3 && $a3<=999){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }


        if ( 100<=$a4 && $a4<=999) {
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }


        if (100<=$a5 && $a5<=999){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }


        if (100<=$a6 && $a6<=999){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }

        if (($a2+$a4+$a6)/3==$a7){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }


        if (100<=$b1 && $b1<=999){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }


        if (100<=$b2 && $b2<=999){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }


        if (($b1*1)/$b2==$b3){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }


        if (100<=$b4 && $b4<=999){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }


        if (0<=$b4 && $b4<=99){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }

        if (($b4*2)/$b5==$b6){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }


        if (100<=$b7 && $b7<=999){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }

        if (0<=$b8 && $b8<=99){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }

        if (($b7*13)/$b8==$b9){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }
        if ( ($b3+$b6+$b9)/3 == $b10){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }


        if (100<=$c1 && $c1<=999){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }


        if (100/(200*$c1) == $c2){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }


        if (100<=$c3 && $c3<=999){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }

        if (1000/(500*$c3) == $c4){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }


        if (100<=$c3 && $c3<=999){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }


        if (4000/(1000*$c5) == $c6){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }

        if (($c2+$c4+$c5)/3 == $c7){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }


        if (100<=$d1 && $d1<=999){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }


        if (0<=$d2 && $d2<=99){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }


        if (($d1*1)/$d2 == $d3){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }


        if (100<=$d4 && $d4<=999){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }


        if (0<=$d5 && $d5<=99){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }


        if (($d4*2)/$d5 == $c6){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }


        if (100<=$d7 && $d7<=999){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }

        if (0<=$d8 && $d8<=99){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }

        if (($d7*1)/$d8 == $d9){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }

        if (($d3+$d6+$d9)/3 == $d10){
            $obj_grade += 2;
        }else{
            $obj_grade += 0;
        }

        if ($e1 == 'A' || $e1 == 'a'){
            $obj_grade += 10;
        }else{
            $obj_grade += 0;
        }

        if ($e2 == 'C' || $e2 == 'c'){
            $obj_grade += 10;
        }else{
            $obj_grade += 0;
        }

        if ($e3 == 'T' || $e3 == 't'){
            $obj_grade += 6;
        }else{
            $obj_grade += 0;
        }

        if ($e4 == 'F' || $e3 == 'f'){
            $obj_grade += 6;
        }else{
            $obj_grade += 0;
        }


        DB::table('exp_3')->insert([
            'stu_id' => $stu_id,
            'class' => $class,
            'obj_grade' =>$obj_grade
        ]);
        self::create([
            'stu_id' => $stu_id,
            'a1' => $a1,
            'a2' => $a2,
            'a3' => $a3,
            'a4' => $a4,
            'a5' => $a5,
            'a6' => $a6,
            'a7' => $a7,
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
            'c1' => $c1,
            'c2' => $c2,
            'c3' => $c3,
            'c4' => $c4,
            'c5' => $c5,
            'c6' => $c6,
            'c7' => $c7,
            'd1' => $d1,
            'd2' => $d2,
            'd3' => $d3,
            'd4' => $d4,
            'd5' => $d5,
            'd6' => $d6,
            'd7' => $d7,
            'd8' => $d8,
            'd9' => $d9,
            'd10' => $d10,
            'e1' => $e1,
            'e2' => $e2,
            'e3' => $e3,
            'e4' => $e4,
        ]);
        return 1;

    }



}
