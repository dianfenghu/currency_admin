<?php
// +----------------------------------------------------------------------
// | 文件说明：全站公共类  
// +----------------------------------------------------------------------
// | Author: wuwu <15093565100@163.com>
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Date: 2017-3-3
// +----------------------------------------------------------------------
namespace app\common\controller;

use think\Controller;
use think\Request;

class Appframe extends Controller
{
    public $request;
    protected $module_name;
    protected $controller_name;
    protected $action_name;

    /**
	 * [_initialize 初始化]
	 * @Author:   yzm<577462987@qq.com>
	 * @DateTime: 2017-03-03T09:55:43+0800
	 * @since:    1.0
	 * @return   
	 */

	public function _initialize()
    {
        $this -> request = Request::instance();//设置请求
        $view = $this -> view;//在这里设全站视图模版变量 方便继承
        $view -> debug = config('app_debug');

    }

    /**
     * [_empty 空方法]
     * @Author:   yzm<577462987@qq.com>
     * @DateTime: 2017-03-03T09:59:30+0800
     * @since:    1.0
     * @param     [type]                    [description]
     * @return    [type]                         [description]
     */
    public function _empty()
    {
        return $this -> show404();
    }

    public function show404()
    {
		header('HTTP/1.1 404 Not Found'); 
		header("status: 404 Not Found"); 
		return view('common@Public:404');
    }

    //添加单条数据动作
    protected function doadd($name,$data){
        $db = db($name);
        return $db->insertGetId($data);
    }

    //修改保存
    protected function save($name,$data){
    	$id = $data['id'];
    	unset($data['id']);
    	return db($name)->where('id',$id)->update($data);
    }
}
