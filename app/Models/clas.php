<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class clas extends Model
{
    // 指定数据表
    protected $table = "clas";
    // 指定开启时间戳
    public $timestamps = true;
    // 指定主键
    protected $primaryKey = "id";
    // 指定不允许自动填充的字段，字段修改的黑名单
    protected $guarded = [];

    /**
     * 在添加班级前，检查班级是否已经存在
     *
     * @param Request $request
     * @return false
     */
    public static function add_class_check(Request $request)
    {
        try {
            $cnt = self::select('id')
                ->where('major', '=', $request['major'])
                ->where('class', '=', $request['class'])
                ->count();
            return $cnt;
        } catch (\Exception $e) {
            logError('查找专业班级个数失败！', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 添加新的班级
     *
     * @param Request $request
     * @return bool
     */
    public static function add_new_class(Request $request)
    {
        try {
            self::create([
                'major' => $request['major'],
                'class' => $request['class'],
            ]);
            return true;
        } catch (\Exception $e) {
            logError('添加班级' . $request['class'] . '失败！', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 查询是否存在这个班级
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
            logError('在班级记录表中查找班级' . $class . '失败！', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 删除班级
     *
     * @param Request $request
     * @return false
     */
    public static function del_class($class)
    {
        try {


            self::where('class', '=', $class)
                ->delete();

            return true;
        } catch (\Exception $e) {
            logError('删除班级' . $class . '失败！', [$e->getMessage()]);
            return false;
        }
    }
}
