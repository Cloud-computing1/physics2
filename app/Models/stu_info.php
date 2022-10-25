<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class stu_info extends Model implements JWTSubject
{
    use Notifiable;

    protected $table = 'stu_info';
    protected $remeberTokenName = NULL;
    protected $guarded = [];
    protected $fillable=['level','grade','major','class','stu_name','stu_id'];



    public function getJWTCustomClaims()
    {
        // TODO: Implement getJWTCustomClaims() method.
        return [];
    }




    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.
        return $this->getKey();
    }



    /**
     * 填写学生个人学生信息
     * @param $stu_name
     * @param $level
     * @param $grade
     * @param $major
     * @param $class
     * @param $stu_id
     * @return mixed
     */
    public static function stu_create($stu_name,$level,$grade,$major,$class,$stu_id)
    {
            return self::create([
                'stu_name'=>$stu_name,
                'level' => $level,
                'grade' => $grade,
                'major' => $major,
                'class' => $class,
                'stu_id'=> $stu_id,
            ]);
        }
}
