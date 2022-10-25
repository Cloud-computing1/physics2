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

    public static function get_majors(){
        $res = self::select('major_name as major')->get();
        return $res;
    }
}
