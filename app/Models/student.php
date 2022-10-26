<?php

namespace App\Models;



use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

class student extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'student';
    protected $remeberTokenName = NULL;
    protected $guarded = [];
    protected $fillable=[];



    public function getJWTCustomClaims()
    {
        // TODO: Implement getJWTCustomClaims() method.
        return [];
    }


    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.
        return $this->getKey();
    }



    /**
     * 判断该学号是否已经被注册
     * @param $request
     * @return false
     */
    public static function checknumber($request)
    {
        $student_job_number = $request['stu_id'];
        try{
            $cunt = student::select('stu_id')
                ->where('stu_id',$student_job_number)
                ->count();
            return $cunt;
        }catch (\Exception $e) {
            logError("账号查询失败！", [$e->getMessage()]);
            return false;
        }
    }



    /**
     * 将学生的学号、密码、邮件添加到数据库
     * @param $request
     * @return false|void
     */
    public static function createUser($request)
    {
        try {
            $student_id = self::create(
                [
                    'stu_id' => $request['stu_id'],
                    'password' => $request['password'],
                    'email' => $request['email'],
                ]
            )->id;
            return $student_id ?
                $student_id :
                false;
        } catch (\Exception $e) {
            logError('添加用户失败!', [$e->getMessage()]);
            die($e->getMessage());
        }
    }

    /**
     * 查询所有学生的信息
     *
     * @return
     */
    public static function get_stus_info()
    {
        try {
            $res = self::join('stu_info', 'student.stu_id', 'stu_info.stu_id')
                ->join('teach_class', 'stu_info.class', 'teach_class.class')
                ->select('student.stu_id as stu_id', 'stu_info.stu_name as stu_name', 'student.email as email',
                    'stu_info.class as class', 'stu_info.level as level', 'teach_class.teacher_name as teacher_name')
                ->get();
            return $res;
        } catch (\Exception $e) {
            logError('查询所有学生的信息失败！', [$e->getMessage()]);

            return false;
        }
    }




    /**
     * 在数据库更新学生密码
     * @param $stu_id
     * @param $jiami
     * @return false
     */
    public static function stu_update($stu_id,$jiami){
        try {
            return self::where('stu_id','=',$stu_id)->update([
                'password' =>$jiami
            ]);
        }catch (\Exception $e){
            logError('操作失败',[$e->getMessage()]);
            return false;
        }

    }



    /**
     * 获取前端传过来的学号、密码
     * @param $request
     * @return array
     */
    protected function credentials($request)
    {
        return ['stu_id' =>$request['stu_id'],'password' => $request['password']];
    }

    /**
     * 删除学生的基本信息和账号
     *
     * @param $stu_id
     * @return bool
     */
    public static function del_stu($stu_id)
    {
        try {
            self::where('stu_id', '=', $stu_id)->delete();
            DB::table('stu_info')->where('stu_id', '=', $stu_id)->delete();
            return true;
        } catch (\Exception $e) {
            logError('删除学生' . $stu_id . '失败！', [$e->getMessage()]);
            return false;
        }
    }


}
