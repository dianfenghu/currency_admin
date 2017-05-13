<?php
// +----------------------------------------------------------------------
// | 文件说明：后台公共类  
// +----------------------------------------------------------------------
// | Author: wuwu <15093565100@163.com>
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Date: 2017-3-3
// +----------------------------------------------------------------------
namespace app\common\controller;

use app\common\controller\Appframe;
use think\Session;

class Adminbase extends Appframe
{
    /**
    * [_initialize 初始化]
    * @Author:   yzm<577462987@qq.com>
    * @DateTime: 2017-03-03T09:55:43+0800
    * @since:    1.0
    * @return   
    */
   
    public function _initialize(){
        if(Session::get('ext_user') ==''){
            $this->error("请您先登录！",Url("Login/login"));
        }else{
            parent::_initialize();
            $db = \think\Db::name('admin_menu');
            $son = 'son';
            $data = self::getmenu(0,$db,$son);
            $this -> view -> adminmenu = $data;
        }
    }

    //获取后台自定义菜单
    protected static function getmenu($pid,$db,$son){
        $res = $db -> where('pid',$pid) -> select();
        if(!empty($res)){
            foreach ($res as $key => $value) {
                $res[$key][$son] = self::getmenu($value['id'],$db,$son);
            }
        }

        return $res;
    }
}
