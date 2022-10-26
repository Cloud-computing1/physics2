<?php

namespace App\Http\Controllers;

use App\Model\Stu_info;
use Illuminate\Http\Request;

class stuInfoController extends Controller
{
    public function stuinfo()
    {
        $stu_id = auth("api")->user()->stu_id;
        $result = Stu_info::StuinfoFind($stu_id);
        return $result?
            json_success("操作成功",$result,200):
            json_fail("操作失败",null,100);

    }

    public function stuscore(Request $request){
        $stu_id = auth("api")->user()->stu_id;
        $exp = request('exp');
        $result = Stu_info::StuexpFind($exp,$stu_id);

        return $result?
            json_success("操作成功",$result,200):
            json_fail("操作失败",null,100);

    }
}
