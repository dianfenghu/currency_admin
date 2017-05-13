<?php
// +----------------------------------------------------------------------
// | 文件说明：管理规则模型  
// +----------------------------------------------------------------------
// | Author: wuwu <15093565100@163.com>
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Date: 2017-3-24
// +----------------------------------------------------------------------
namespace app\admin\model;

use think\Model;

class User extends Model
{
     //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }

    public function checkGroup($uid) {
    	$group = db('auth_group_access')->where('id',$uid)->find();
    	if(!$group) {
    		return true;
    	}else {
    		return false;
    	}
    }
    public static function login($name, $password)
    {

        $where['name'] = $name;
        $where['password'] = md5($password);

        $user=db('user')->where($where)->find();
        if ($user) {
            unset($user["password"]);
            session("ext_user", $user);
            return true;
        }else{
            return false;
        }
    }

}