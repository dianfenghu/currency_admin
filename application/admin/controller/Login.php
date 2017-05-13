<?php
// +----------------------------------------------------------------------
// | 文件说明：后台内容管理  
// +----------------------------------------------------------------------
// | Author: wuwu <15093565100@163.com>
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Date: 2017-3-24
// +----------------------------------------------------------------------
namespace app\admin\controller;
use think\Controller;
use think\Request;
use app\admin\model\User as UserModel;
use think\Session;

class Login extends controller
{
	
	public function _initialize()
    {
        parent::_initialize();
    }
    //后台列表页
    public function login()
    {
    	
      return view();
    }

    //验证码
    public function logining(){
		    $name = input('request.name');
		    $password  = input('request.password');
		    $data = input('request.captcha');
		    // dump($data);
		    if(!captcha_check($data)){
		       //验证失败
		          return $this->error("验证码错误");
		      };

		  	$check=UserModel::login($name, $password);
		    if ($check) {
		       		header("location:".url('index/index'));

					exit();
		       }
		       
		    return view('login/login'); 
    }

    function captcha_img($id = "")
      {
          return '<img src="' . captcha_src($id) . '" alt="captcha" />';
      }


     // 退出登录
    public function logout(){
    	// var_dump(session::get('ext_user'));
        session("ext_user", NULL);
        // Session::set('ext_user',array());
       	header("location:".url('login/login'));
    }
   
    
}

