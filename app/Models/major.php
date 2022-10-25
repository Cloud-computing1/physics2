<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class major extends Model
{
    // 指定数据表
    protected $table = "major";
    // 指定开启时间戳
    public $timestamps = true;
    // 指定主键
    protected $primaryKey = "id";
    // 指定不允许自动填充的字段，字段修改的黑名单
    protected $guarded = [];

    /**
     * 获取所有专业
     *
     * @return mixed
     */
    public static function get_majors()
    {
        try {
            $res = self::select('major_name as major')
                ->orderBy('major')
                ->get();
            return $res;
        } catch (\Exception $e) {
            logError('获取专业失败', [$e->getMessage()]);
            return false;
        }

    }
}
