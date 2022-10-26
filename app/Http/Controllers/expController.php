<?php

namespace App\Http\Controllers;

use App\Models\EXP_1;
use App\Models\exp_ans1;
use App\Models\exp_ans3;
use App\Models\exp_ans4;
use App\Models\student;
use App\services\OSS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class expController extends Controller
{
    //单摆法测重力加速度

    /**
     * 将图片转成URL添加到数据库
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function img(Request $request){
        $stu_id = auth('api')->user()->stu_id;
        $img= $request->file('img');//读取file文件
        $tmppath = $img->getRealPath();//获取文件的真实路径
        $fileName = rand(1000,9999).$img->getFilename().time().date('ymd').'.'.$img->getClientOriginalExtension();
        //拼接文件名
        $pathName = date('Y-m/d').'/'.$fileName;
        OSS::publicUpload('wyhzs',$pathName,$tmppath,['ContentType'=>'inline']);
        //获取文件URl
        $OSS_url  =OSS::getPublicObjectURL('wyhzs',$pathName);
        $date = exp_ans1::expcreate($OSS_url,$stu_id);
        return $OSS_url?
            json_success("操作成功!",$OSS_url,200):
            json_fail("操作失败!",null,100);
    }


    /**
     * 单摆测测重力加速度
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function t(Request $request)
    {
        $stu_id = auth('api')->user()->stu_id;
        $cnt = exp_ans1::checknumber2($stu_id);
        if ($cnt == 0){
            $class = DB::table('stu_info')->where('stu_id',$stu_id)->value('class');//利用学号查找邮件
            $date = $request->all();
            $obj_grade = 0;
            $a1 = $request['a1'];
            $b1 = $request['b1'];
            $b2 = $request['b2'];
            $b3 = $request['b3'];
            $b4 = $request['b4'];
            $b5 = $request['b5'];
            $b6 = $request['b6'];
            $b7 = $request['b7'];
            $b8 = $request['b8'];
            $b9 = $request['b9'];
            $b10 = $request['b10'];
            $b11 = $request['b11'];
            $b12 = $request['b12'];
            $b13 = $request['b13'];
            $b14 = $request['b14'];
            $b15 = $request['b15'];
            $b16 = $request['b16'];
            $b17 = $request['b17'];
            $d1 = $request['d1'];
            $d2 = $request['d2'];
            $d3 = $request['d3'];

//            $a1 = $request[0];
//            $b1 = $request[1];
//            $b2 = $request[2];
//            $b3 = $request[3];
//            $b4 = $request[4];
//            $b5 = $request[5];
//            $b6 = $request[6];
//            $b7 = $request[7];
//            $b8 = $request[8];
//            $b9 = $request[9];
//            $b10 = $request[10];
//            $b11 = $request[11];
//            $b12 = $request[12];
//            $b13 = $request[13];
//            $b14 = $request[14];
//            $b15 = $request[15];
//            $b16 = $request[16];
//            $b17 = $request[17];
//            $d1 = $request[18];
//            $d2 = $request[19];
//            $d3 = $request[20];
            $res = exp_ans1::tcreate($a1,$b1,$b2,$b3,$b4,$b5,$b6,$b7,$b8,$b9,$b10,$b11,$b12,$b13,$b14,$b15,$b16,$b17,$d1,$d2,$d3,$stu_id,$obj_grade,$class);
            return $res?
                json_success("操作成功!",$date,200):
                json_fail("操作失败!",null,100);
        }else{
            return json_success("提交失败！你已经提交过答案了！", null, 100);
        }
        }


    /**
     * 自组式直流电桥测电阻
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function exp_3(Request $request){
        $stu_id = auth('api')->user()->stu_id;
        $class = DB::table('stu_info')->where('stu_id',$stu_id)->value('class');//利用学号查找邮件
        $cnt = exp_ans3::checknumber3($stu_id);
        if($cnt == 0)
        {
            $data = $request->all();
            $obj_grade = 0;
//        $a1 =$request[0];
//        $a2 =$request[1];
//        $a3 =$request[2];
//        $a4 =$request[3];
//        $a5 =$request[4];
//        $a6 =$request[5];
//        $a7 =$request[6];
//        $b1 =$request[7];
//        $b2 =$request[8];
//        $b3 =$request[9];
//        $b4 =$request[10];
//        $b5 =$request[11];
//        $b6 =$request[12];
//        $b7 =$request[13];
//        $b8 =$request[14];
//        $b9 =$request[15];
//        $b10 =$request[16];
//        $c1 =$request[17];
//        $c2 =$request[18];
//        $c3 =$request[19];
//        $c4 =$request[20];
//        $c5 =$request[21];
//        $c6 =$request[22];
//        $c7 =$request[23];
//        $d1 =$request[24];
//        $d2 =$request[25];
//        $d3 =$request[26];
//        $d4 =$request[27];
//        $d5 =$request[28];
//        $d6 =$request[29];
//        $d7 =$request[30];
//        $d8 =$request[31];
//        $d9 =$request[32];
//        $d10 =$request[33];
//        $e1 = $request[34];
//        $e2 = $request[35];
//        $e3 = $request[36];
//        $e4 = $request[37];
//        $stu_id = $request[38];
            $a1 = $request['a1'];
            $a2 = $request['a2'];
            $a3 = $request['a3'];
            $a4 = $request['a4'];
            $a5 = $request['a5'];
            $a6 = $request['a6'];
            $a7 = $request['a7'];
            $b1 = $request['b1'];
            $b2 = $request['b2'];
            $b3 = $request['b3'];
            $b4 = $request['b4'];
            $b5 = $request['b5'];
            $b6 = $request['b6'];
            $b7 = $request['b7'];
            $b8 = $request['b8'];
            $b9 = $request['b9'];
            $b10 = $request['b10'];
            $c1 = $request['c1'];
            $c2 = $request['c2'];
            $c3 = $request['c3'];
            $c4 = $request['c4'];
            $c5 = $request['c5'];
            $c6 = $request['c6'];
            $c7 = $request['c7'];
            $d1 = $request['d1'];
            $d2 = $request['d2'];
            $d3 = $request['d3'];
            $d4 = $request['d4'];
            $d5 = $request['d5'];
            $d6 = $request['d6'];
            $d7 = $request['d7'];
            $d8 = $request['d8'];
            $d9 = $request['d9'];
            $d10 = $request['d10'];
            $e1 = $request['e1'];
            $e2 = $request['e2'];
            $e3 = $request['e3'];
            $e4 = $request['e4'];
            $res1 = exp_ans3::Test3($a1,$a2,$a3,$a4,$a5,$a6,$a7,$b1,$b2,$b3,$b4,$b5,$b6,$b7,$b8,$b9,$b10,
                $c1,$c2,$c3,$c4,$c5,$c6,$c7,$d1,$d2,$d3,$d4,$d5,$d6,$d7,$d8,$d9,$d10,$e1,$e2,$e3,$e4,$obj_grade,$stu_id,$class,$data);
            return $res1?
                response()-> json(200):
                response()-> json(100);
        }else{
            return json_success("提交失败！你已经提交过答案了！", null, 100);
        }

    }


    /**
     * 欧姆表的改装设计
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function exp_4(Request $request){
        $stu_id = auth('api')->user()->stu_id;
        $class = DB::table('stu_info')->where('stu_id',$stu_id)->value('class');//利用学号查找班级
        $cnt = exp_ans4::checknumber4($stu_id);
        if ($cnt == 0){
            $data = $request->all();
            $obj_grade = 0;
//        $a1 =$request[0];
//        $a2 =$request[1];
//        $a3 =$request[2];
//        $b1 =$request[3];
//        $b2 =$request[4];
//        $b3 =$request[5];
//        $b4 =$request[6];
//        $b5 =$request[7];
//        $b6 =$request[8];
//        $b7 =$request[9];
//        $b8 =$request[10];
//        $c1 =$request[11];
//        $c2 =$request[12];
//        $c3 =$request[13];
//        $d1 =$request[14];
//        $d2 =$request[15];
//        $d3 =$request[16];
            $a1 = $request['a1'];
            $a2 = $request['a2'];
            $a3 = $request['a3'];
            $b1 = $request['b1'];
            $b2 = $request['b2'];
            $b3 = $request['b3'];
            $b4 = $request['b4'];
            $b5 = $request['b5'];
            $b6 = $request['b6'];
            $b7 = $request['b7'];
            $b8 = $request['b8'];
            $c1 = $request['c1'];
            $c2 = $request['c2'];
            $c3 = $request['c3'];
            $d1 = $request['d1'];
            $d2 = $request['d2'];
            $d3 = $request['d3'];
            $res2 = exp_ans4::Test4($a1,$a2,$a3,$b1,$b2,$b3,$b4,$b5,$b6,$b7,$b8,$c1,$c2,$c3,$d1,$d2,$d3,$obj_grade,$stu_id,$class);
            return $res2?
                response()-> json(200):
                response()-> json(100);
        }else{
            return json_success("提交失败！你已经提交过答案了！", null, 100);
        }
    }


    /**
     * 自组式直流电桥测电阻的图片提交
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function img3(Request $request){
        $stu_id = auth('api')->user()->stu_id;
        $img= $request->file('img');//读取file文件
        $tmppath = $img->getRealPath();//获取文件的真实路径
        $fileName = rand(1000,9999).$img->getFilename().time().date('ymd').'.'.$img->getClientOriginalExtension();
        //拼接文件名
        $pathName = date('Y-m/d').'/'.$fileName;
        OSS::publicUpload('wyhzs',$pathName,$tmppath,['ContentType'=>'inline']);
        //获取文件URl
        $OSS_url  =OSS::getPublicObjectURL('wyhzs',$pathName);
        $date = exp_ans3::expcreate($OSS_url,$stu_id);
        return $OSS_url?
            json_success("操作成功!",$OSS_url,200):
            json_fail("操作失败!",null,100);
    }


    /**
     * 欧姆表的改装设计图片1的提交
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function img4_1(Request $request){
        $stu_id = auth('api')->user()->stu_id;
        $img= $request->file('img');//读取file文件
        $tmppath = $img->getRealPath();//获取文件的真实路径
        $fileName = rand(1000,9999).$img->getFilename().time().date('ymd').'.'.$img->getClientOriginalExtension();
        //拼接文件名
        $pathName = date('Y-m/d').'/'.$fileName;
        OSS::publicUpload('wyhzs',$pathName,$tmppath,['ContentType'=>'inline']);
        //获取文件URl
        $OSS_url1  =OSS::getPublicObjectURL('wyhzs',$pathName);
        $date = exp_ans4::expcreate1($OSS_url1,$stu_id);
        return $OSS_url1?
            json_success("操作成功!",$OSS_url1,200):
            json_fail("操作失败!",null,100);
    }


    /**
     * 欧姆表的改装设计图片2的提交
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function img4_2(Request $request){
        $stu_id = auth('api')->user()->stu_id;
        $img= $request->file('img');//读取file文件
        $tmppath = $img->getRealPath();//获取文件的真实路径
        $fileName = rand(1000,9999).$img->getFilename().time().date('ymd').'.'.$img->getClientOriginalExtension();
        //拼接文件名
        $pathName = date('Y-m/d').'/'.$fileName;
        OSS::publicUpload('wyhzs',$pathName,$tmppath,['ContentType'=>'inline']);
        //获取文件URl
        $OSS_url2  =OSS::getPublicObjectURL('wyhzs',$pathName);
        $date = exp_ans4::expcreate2($OSS_url2,$stu_id);
        return $OSS_url2?
            json_success("操作成功!",$OSS_url2,200):
            json_fail("操作失败!",null,100);
    }


}
