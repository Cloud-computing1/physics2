<?php

namespace App\Models;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class admin extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'admin';
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $fillable = ['admin', 'password'];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

//    // 检查用户名是否重复
//    public static function regi_check(Request $request)
//    {
//        try {
//            $account = $request['admin'];
//            $cnt = self::select('admin')
//                ->where('admin', $account)
//                ->count();
//            return $cnt;
//        } catch (\Exception $e) {
//            logError('查找账号个数失败！', [$e->getMessage()]);
//            return false;
//        }
//
//    }
//
//    // 注册用户
//    public static function register(Request $request)
//    {
//        try {
//            $account = $request['admin'];
//            $password = $request['password'];
//            $res = self::create([
//                'admin' => $account,
//                'password' => $password
//            ]);
//            return $res['admin'];
//        } catch (\Exception $e) {
//            logError('注册失败！', [$e->getMessage()]);
//            return false;
//        }
//    }

}
