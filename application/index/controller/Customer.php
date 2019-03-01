<?php
/**
 * Created by PhpStorm.
 * User: Happy233
 * Date: 2019/2/21
 * Time: 15:13
 */

namespace app\index\controller;

use app\common\Controller;
use app\index\model\WorkDetail;
use think\Request;

class Customer extends Controller
{

    public function index() {
        return "Customer Index";
    }

    public function info(Request $request) {
        $work = $request->work;
        return $this->api($work->visible(['name', 'start_time', 'duration']));
    }

    public function emit(Request $request) {
        $work = $request->work;
        $data = $request->post(['name', 'stu_id', 'college', 'evaluation', 'message']);
        $result = $this->validate($data, 'app\index\validate\WorkDetail.create');
        if ($result !== true) {
            return $this->api(null, 1, $result);
        }
        $data['id'] = $work->id;
        $detail = new WorkDetail();
        $detail->save($data);
        return $this->api();
    }

}