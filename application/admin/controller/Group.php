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
use app\common\controller\Adminbase;
use app\admin\model\AuthGroup;
class Group extends Adminbase
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

        $list = AuthGroup::all();
        $this->assign('list', $list);
        return $this->fetch();
    }

    //删除
    public function delete($id){
        $res = AuthGroup::destroy($id);
        if($res){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    //添加
    public function add(){
        if(!$this -> request -> isPost()){
            // $data = \app\admin\model\AuthRule::field('title,id')->select();
            // $this->assign('data', $data);
            return $this->fetch();
        }

        $data = request()->post();
        //执行公共方法doadd 添加单条数据并返回id 
        $res = $this -> doadd('auth_group',$data);
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

    public function auth() {
        if(!request()->isPost()) {
            $grouprules = db('auth_group')->where('id',input('id'))->find();
            $this->assign('rules',$grouprules);
            $this->assign('auth',$this->menuList());
        }

        return $this->fetch();
    }

    protected static function menuList($pid=0) {
        $data = db('auth_rule')->where('pid',$pid)->select();
        if($data) {
            foreach($data as $k=>$v) {
                $data[$k]['zi'] = self::menuList($v['id']);
            }
        }
        return $data;
    }     
}

