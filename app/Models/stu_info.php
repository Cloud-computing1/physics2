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
}
