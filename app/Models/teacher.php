<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class teacher extends Model
{
    // 指定数据表
    protected $table = "teacher";
    // 指定开启时间戳
    public $timestamps = true;
    // 指定主键
    protected $primaryKey = "id";
    // 指定不允许自动填充的字段，字段修改的黑名单
    protected $guarded = [];

    /**
     *获取所有老师的信息
     *
     * @return
     */
    public static function get_teachers_info()
    {
        try {
            $res = self::select('teacher_id', 'teacher_name', 'teacher_email')->get();
            return $res;
        } catch (\Exception $e) {
            logError('查询所有老师的信息失败！', [$e->getMessage()]);
            return false;
        }
    }

    /**
     *通过工号找到并删除老师
     *
     * @param $teacher_id
     * @return bool
     */
    public static function del_teacher($teacher_id)
    {
        try {
            self::where('teacher_id', '=', $teacher_id)->delete();
            DB::table('teach_class')->where('teacher_id', '=', $teacher_id)->delete();
            return true;
        } catch (\Exception $e) {
            logError('删除老师' . $teacher_id . '失败！', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 在添加老师之前，先通过查询，返回当前注册的工号已被注册的个数
     *
     * @param $teacher_id
     * @return
     */
    public static function add_check($teacher_id)
    {
        try {
            $cnt = self::select('teacher_id')
                ->where('teacher_id', '=', $teacher_id)
                ->count();
            return $cnt;
        } catch (\Exception $e) {
            logError('查找工号个数失败！', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 添加老师
     *
     * @param Request $request
     * @return bool
     */
    public static function add_teacher(Request $request)
    {
        try {
            self::create([
                'teacher_id' => $request['teacher_id'],
                'password' => $request['password'],
                'teacher_name' => $request['teacher_name'],
                'teacher_email' =>$request['teacher_email']
            ]);
            return true;
        } catch (\Exception $e) {
            logError('添加老师' . $request['teacher_id'] . '失败！', [$e->getMessage()]);
            return false;
        }
    }
}
