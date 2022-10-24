<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
