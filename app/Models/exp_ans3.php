<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class exp_ans3 extends Model
{
    // 指定数据表
    protected $table = "exp_ans3";
    // 指定开启时间戳
    public $timestamps = true;
    // 指定主键
    protected $primaryKey = "id";
    // 指定不允许自动填充的字段，字段修改的黑名单
    protected $guarded = [];

    /**
     * 检查实验的记录表中是否存在此学生的记录
     *
     * @param $stu_id
     * @return bool|false
     */
    public static function find_someone($stu_id)
    {
        try {
            $cnt = self::select('*')
                ->where('stu_id', '=', $stu_id)
                ->count();
            if ($cnt > 0) {
                return true;
            } else {
                return false;
            }

        } catch (\Exception $e) {
            logError('在实验三记录表中查找学生失败！', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 在实验的记录表中删除某个学生
     *
     * @param $stu_id
     * @return false
     */
    public static function del_someone($stu_id)
    {
        try {
            $cnt = self::where('stu_id', '=', $stu_id)
                ->delete();
            return $cnt;
        } catch (\Exception $e){
            logError('在实验三记录表中删除学生失败！', [$e->getMessage()]);
            return false;
        }
    }
}
