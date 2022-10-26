<?php

namespace App\Models;


use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class stu_info extends Model implements JWTSubject
{
    use Notifiable;

    protected $table = 'stu_info';
    protected $remeberTokenName = NULL;
    protected $guarded = [];
    protected $fillable=['level','grade','major','class','stu_name','stu_id'];



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
     * 填写学生个人学生信息
     * @param $stu_name
     * @param $level
     * @param $grade
     * @param $major
     * @param $class
     * @param $stu_id
     * @return mixed
     */
    public static function stu_create($stu_name,$level,$grade,$major,$class,$stu_id)
    {
            return self::create([
                'stu_name'=>$stu_name,
                'level' => $level,
                'grade' => $grade,
                'major' => $major,
                'class' => $class,
                'stu_id'=> $stu_id,
            ]);
        }



    /**
     * 修改某个学生的信息
     *
     * @param Request $request
     * @return false|int
     */
    public static function mod_stu_info(Request $request)
    {
        try {
            $cnt = self::where('stu_id', $request['stu_id'])
                ->update([
                    'class' => $request['class']
                ]);
            return $cnt;
        } catch (\Exception $e) {
            logError('修改学生的信息失败！', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 查询是否有学生在这个班级
     *
     * @param $class
     * @return bool
     */
    public static function find_someclass($class)
    {
        try {
            $cnt = self::select('id')
                ->where('class', '=', $class)
                ->count();
            if ($cnt > 0) {
                return true;
            } else {
                return false;
            }

        } catch (\Exception $e) {
            logError('在学生信息表中查找班级' . $class . '失败！', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 管理员删除班级时，将学生信息表中的班级字段设置为null
     *
     * @param $class
     * @return false
     */
    public static function remove_class($class)
    {
        try {
            $cnt = self::where('class', '=', $class)->update([
                'class' => null
            ]);
            return $cnt;
        } catch (\Exception $e) {
            logError('将学生移出班级失败失败！', [$e->getMessage()]);
            return false;
        }
    }

}
