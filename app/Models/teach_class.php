<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
