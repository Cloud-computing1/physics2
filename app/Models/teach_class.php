<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class teach_class extends Model
{
    // 指定数据表
    protected $table = "teach_class";
    // 指定开启时间戳
    public $timestamps = true;
    // 指定主键
    protected $primaryKey = "id";
    // 指定不允许自动填充的字段，字段修改的黑名单
    protected $guarded = [];

    /**
     * 查询是否有老师在教学这个班级
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
            logError('在教学班级记录表中查找班级' . $class . '失败！', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 在教学班级记录表中删除指定的班级
     *
     * @param $class
     * @return bool
     */
    public static function del_class($class)
    {
        try {
            $cnt = self::where('class', '=', $class)->delete();
            if ($cnt > 0) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            logError('在教学班级记录表中删除班级' . $class . '失败！', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 为老师添加教学的班级
     *
     * @param Request $request
     * @return bool
     */
    public static function add_class_to(Request $request)
    {
        try {
            $cnt = self::create([
                'teacher_id' => $request['teacher_id'],
                'teacher_name' => $request['teacher_name'],
                'major' => $request['major'],
                'class' => $request['class']
            ])->count();
            if ($cnt > 0) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            logError('为老师' . $request['teacher_name'] . '添加教学班级' . $request['class'] . '失败！', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 为老师删除某个教学班级
     *
     * @param Request $request
     * @return bool
     */
    public static function del_class_from(Request $request)
    {
        try {
            $cnt = self::where('class', '=', $request['class'])
                ->where('teacher_id','=',$request['teacher_id'])->delete();
            if ($cnt > 0) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            logError('在教学班级记录表中删除班级' . $request['class'] . '失败！', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 获取教师教学的专业
     *
     * @param $teacher_id
     * @return false
     */
    public static function get_teach_major($teacher_id)
    {
        try {
            $res = self::select('major')
                ->where('teacher_id', '=', $teacher_id)
                ->orderBy('major')
                ->get();
            return $res;
        } catch (\Exception $e) {
            logError('获取教师教学专业失败', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 获取教师教学的班级
     *
     * @param $request
     * @return false
     */
    public static function get_teach_class($array)
    {
        try {
            $res = self::select('class')
                ->where('teacher_id', '=', $array['teacher_id'])
                ->where('major', '=', $array['major'])
                ->orderBy('class')
                ->get();
            return $res;
        } catch (\Exception $e) {
            logError('获取教师教学班级失败', [$e->getMessage()]);
            return false;
        }
    }
}
