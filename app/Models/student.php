<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class student extends Model
{
    // 指定数据表
    protected $table = "student";
    // 指定开启时间戳
    public $timestamps = true;
    // 指定主键
    protected $primaryKey = "id";
    // 指定不允许自动填充的字段，字段修改的黑名单
    protected $guarded = [];

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
