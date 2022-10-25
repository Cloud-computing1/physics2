<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class stu_info extends Model
{
    // 指定数据表
    protected $table = "stu_info";
    // 指定开启时间戳
    public $timestamps = true;
    // 指定主键
    protected $primaryKey = "id";
    // 指定不允许自动填充的字段，字段修改的黑名单
    protected $guarded = [];


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
