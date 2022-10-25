<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\clas;
use App\Models\exp_1;
use App\Models\exp_2;
use App\Models\exp_3;
use App\Models\exp_4;
use App\Models\exp_ans1;
use App\Models\exp_ans2;
use App\Models\exp_ans3;
use App\Models\exp_ans4;
use App\Models\stu_info;
use App\Models\student;
use App\Models\teacher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
//    public function register(Request $request){
//        // 检查账号是否已被注册
//        $cnt = admin::regi_check($request);
//        if ($cnt == 0) {
//            // 对密码进行加密
//            $regi = self::adminHandle($request);
//            // 创建用户
//            $account = admin::register($regi);
//            return $account ?
//                json_success("注册成功", $account, 200) :
//                json_fail('注册失败', null, 100);
//        } else {
//            $data = "账号已被注册 {$cnt} 个";
//            return json_fail('注册失败', $data, 100);
//        }
//    }
//
    // 密码加密
    protected function adminHandle($request)
    {
        // Bcrypt是单向Hash加密算法，类似Pbkdf2算法 不可反向破解生成明文。
        $request['password'] = bcrypt($request['password']);
        return $request;
    }

    /**
     * 管理员登录
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = self::get_credentials($request);
        $token = auth('api')->attempt($credentials);
        if (!$token) {
            return json_fail('登录失败', ['error' => 'Unauthorized'], 401);

        }

        return $this->respondWithToken($token, '登录成功');
    }

    /**
     * 从请求中提取凭证，以数组返回
     *
     * @param Request $request
     * @return array
     */
    protected function get_credentials(Request $request)
    {
        return ['admin' => $request['admin'], 'password' => $request['password']];
    }

    /**
     * 携带token的响应
     *
     * @param $token
     * @param $msg
     * @return JsonResponse
     */
    protected function respondWithToken($token, $msg)
    {
        return json_success($msg, array(
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60),
            200);
    }

    /**
     * 获取所有学生的信息
     *
     * @return JsonResponse
     */
    public function get_stu_detail()
    {
        $res = student::get_stus_info();
        return $res ?
            json_success("查询成功!", $res, 200) :
            json_fail("查询失败!", null, 100);
    }

    /**
     * 修改某个学生的班级
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function mod_stu_info(Request $request)
    {
        $res = stu_info::mod_stu_info($request);
        return $res ?
            json_success('修改成功', $res, 200) :
            json_fail('修改失败', null, 100);
    }

    /**
     * 通过传入的id，删除某个学生
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function del_stu(Request $request)
    {
        $stu_id = $request['stu_id'];
        $status1 = true;
        $status2 = true;
        $status3 = true;
        $status4 = true;
        $status_ans1 = true;
        $status_ans2 = true;
        $status_ans3 = true;
        $status_ans4 = true;

        // 删除学生的基本信息和账号
        $status = student::del_stu($stu_id);

        // 删除学生的各个实验的成绩记录
        if (exp_1::find_someone($stu_id)) {
            $status1 = false;
            $status1 = exp_1::del_someone($stu_id);
        }
        if (exp_2::find_someone($stu_id)) {
            $status2 = false;
            $status2 = exp_2::del_someone($stu_id);
        }
        if (exp_3::find_someone($stu_id)) {
            $status3 = false;
            $status3 = exp_3::del_someone($stu_id);
        }
        if (exp_4::find_someone($stu_id)) {
            $status4 = false;
            $status4 = exp_4::del_someone($stu_id);
        }

        // 删除学生各个实验中的做题记录
        if (exp_ans1::find_someone($stu_id)) {
            $status_ans1 = false;
            $status_ans1 = exp_ans1::del_someone($stu_id);
        }
        if (exp_ans2::find_someone($stu_id)) {
            $status_ans2 = false;
            $status_ans2 = exp_ans2::del_someone($stu_id);
        }
        if (exp_ans3::find_someone($stu_id)) {
            $status_ans3 = false;
            $status_ans3 = exp_ans3::del_someone($stu_id);
        }
        if (exp_ans4::find_someone($stu_id)) {
            $status_ans4 = false;
            $status_ans4 = exp_ans4::del_someone($stu_id);
        }

        if ($status &&
            $status1 && $status2 && $status3 && $status4 &&
            $status_ans1 && $status_ans2 && $status_ans3 && $status_ans4) {
            return json_success('删除学生成功', $stu_id, 200);
        } else {
            return json_fail('删除学生失败', null, 100);
        }
    }

    /**
     * 获取所有老师的信息
     *
     * @return JsonResponse
     */
    public function get_teachers_info()
    {
        $res = teacher::get_teachers_info();
        return $res ?
            json_success("查询所有老师成功!", $res, 200) :
            json_fail("查询所有老师失败!", null, 100);
    }

    /**
     * 通过工号找到并删除老师
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function del_teacher(Request $request)
    {
        $teacher_id = $request['teacher_id'];
        $res = teacher::del_teacher($teacher_id);
        return $res ?
            json_success("删除老师成功!", $teacher_id, 200) :
            json_fail("删除老师失败!", null, 100);
    }

    /**
     * 添加教师
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function add_teacher(Request $request)
    {
        $teacher_id = $request['teacher_id'];
        $cnt = teacher::add_check($teacher_id);
        if ($cnt == 0) {
            $request = self::adminHandle($request);
            $res = teacher::add_teacher($request);
            return $res ?
                json_success('添加老师成功', $teacher_id, 200) :
                json_fail('添加老师失败', null, 100);
        } else {
            return json_fail('添加老师失败，账号已被注册', $teacher_id, 100);
        }
    }

    /**
     * 添加新的班级
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function add_new_class(Request $request){
        $cnt = clas::add_class_check($request);
        if ($cnt == 0) {
            $res = clas::add_new_class($request);
            return $res ?
                json_success('添加班级成功', $request['class'], 200) :
                json_fail('添加班级失败', null, 100);
        } else {
            return json_fail('添加班级失败，目标班级已存在', $request['class'], 100);
        }
    }
}
