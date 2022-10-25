<?php

namespace App\Http\Controllers;

use App\Models\stu_info;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class studentController extends Controller
{



    /**
     * 学生注册
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $cnt = student::checknumber($request);
        if ($cnt == 0) {
            $student_id = student::createUser(self::userhandle($request));
            return $student_id ?
                json_success('注册成功！', $student_id, 200) :
                json_fail('注册失败！', null, 100);
        } else {
            return json_success("注册失败！该学号已经注册过来！", null, 100);
        }

    }



    /**
     * 对密码进行哈希256加密
     * @param $request
     * @return mixed
     */
    protected function userhandle($request)
    {
        $registeredInfo = $request->except('password_confirmation');
        $registeredInfo['password'] = bcrypt($registeredInfo['password']);
        return $registeredInfo;
    }



    /**
     * 学生登录
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = student::credentials($request);   //从前端获取账号密码
        $token = auth('api')->attempt($credentials);   //获取token
        return $token?
            json_success('登录成功!',$token,  200):
            json_fail('登录失败!账号或密码错误',null, 100 ) ;
    }


    /**
     * 发送邮件
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function email_regi(Request $request)
    {
        $eamil = $request ->input('email');
        $suiji = rand(99999,999999);
        Mail::raw("$suiji",function ($message)use ($eamil){
            $message->subject('这是一个验证码');
            $message->to($eamil);
        });
        return $eamil ?
            json_success("已向".$eamil."发送邮件成功!",$suiji,200):
            json_fail("发送邮件失败!",null,100);
    }



    /**
     * 忘记密码发送邮件
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function email_forget(Request $request)
    {
        $stu_id = $request['stu_id'];
        $nam = DB::table('student')->where('stu_id',$stu_id)->value('email');//利用学号查找邮件
        $suiji = rand(100000,999999);
        Mail::raw("$suiji",function ($message)use ($nam){
            $message->subject('这是一个验证码');
            $message->to($nam);
    });
        return $nam ?
            json_success("已向".$nam."发送邮件成功!",$suiji,200):
            json_fail("发送邮件失败!",null,100);
    }



    /**
     * 修改密码
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forget(Request $request)
    {
        $stu_id = $request['stu_id'];
        $password = $request['password'];
        $jiami = self::upstuhandle('$password');//对密码进行加密
        $res =student::stu_update($stu_id,$jiami);
        return $res ?
            json_success("修改密码成功!",$res,200):
            json_fail("修改密码失败!",null,100);
    }



    /**
     * 修改密码时对密码进行哈希256加密
     * @param $request
     * @return string
     */
    protected function upstuhandle($request)
    {
        $upregisteredInofo = bcrypt($request);
        return $upregisteredInofo;
    }



    /**
     * 封装token
     * @param $token
     * @param $msg
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $msg)
    {
        return json_success( $msg, array(
            'token' => $token,
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ),200);
    }



    /**
     * 填写学生个人信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submit_detail(Request $request)
    {
        $stu_id = auth('api')->user()->stu_id;
        $stu_name = $request['stu_name'];
        $level = $request['level'];
        $grade = $request['grade'];
        $major = $request['major'];
        $class = $request['class'];
        $date = stu_info::stu_create($stu_name,$level,$grade,$major,$class,$stu_id);
        return $date ?
            json_success('操作成功!', $date, 200) :
            json_fail('操作失败！', null, 100);
    }



}

