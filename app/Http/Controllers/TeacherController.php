<?php

namespace App\Http\Controllers;

use App\Models\teach_class;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function get_teach_major_t(Request $request)
    {
        $teacher_id = auth('api')->user()->teacher_id;
        $res = teach_class::get_teach_major($teacher_id);
        return $res ?
            json_success('查询专业成功', $res, 200) :
            json_fail('查询专业失败', null, 100);
    }

    public function get_teach_class_t(Request $request)
    {
        $teacher_id = auth('api')->user()->teacher_id;
        $array = array(
            'teacher_id' => $teacher_id,
            'major' => $request['major']
        );
        $res = teach_class::get_teach_class($array);
        return $res ?
            json_success('查询专业成功', $res, 200) :
            json_fail('查询专业失败', null, 100);
    }

}
