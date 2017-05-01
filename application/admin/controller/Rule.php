<?php
// +----------------------------------------------------------------------
// | 文件说明：后台内容管理  
// +----------------------------------------------------------------------
// | Author: wuwu <15093565100@163.com>
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Date: 2017-3-7
// +----------------------------------------------------------------------
namespace app\admin\controller;
use app\common\controller\Adminbase;
use app\admin\model\AuthRule;
class Rule extends Adminbase
{
	/**
	 * [_initialize 初始化]
	 * @Author:   yzm<577462987@qq.com>
	 * @DateTime: 2017-03-03T09:55:43+0800
	 * @since:    1.0
	 * @return   
	 */
	public function _initialize()
    {
        parent::_initialize();
    }
    //后台列表页
    public function index()
    {

        $list = AuthRule::all();
      
        $this->assign('list', $list);
        return $this->fetch();
    }

    //删除
    public function delete($id){
        $db = db('auth_rule');
        if($db -> delete($id)){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    //添加
    public function add(){
        if(!$this -> request -> isPost()){
            return view();
        }

        $data = $this -> request -> post();
        
        $data['status'] = 1;
        //执行公共方法doadd 添加单条数据并返回id 
        $res = $this -> doadd('auth_rule',$data);
        if($res){
            $data['id'] = $res;
            return json($data);
        }
        return json(0);
    }
    
    //修改
    public function update(){
        if(!$this -> request -> isPost()){
            $id = $this -> request -> param('id');
            if(empty($id)){
                return $this -> show404();
            }
            $db = db('auth_rule');
            $data = $db -> find($id);
            $rule = db('auth_rule')->where('pid',0)->select();
            $this ->assign('rule',$rule);
            $this -> view -> vo = $data;
            return view();
        }
        $data = $this -> request -> post();
        if($data['status'] == 'on'){
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }

        $this -> save('auth_rule',$data);
        return json($data);
        
    }       
}

