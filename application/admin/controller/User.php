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
use app\admin\model\User as UserModel;
class User extends Adminbase
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

        // $list = UserModel::all();
        $list = db('user')
        	->alias('u')
        	->join('__AUTH_GROUP_ACCESS__ a','u.id = a.uid')
        	->join('__AUTH_GROUP__ g','a.group_id = g.id')
        	->field('u.*,g.title')
        	->select();
        $this->assign('list', $list);
        return $this->fetch();
    }
    
    //添加
    public function add(){
        if(!$this -> request -> isPost()){
        	$userGroup = db('auth_group')->where('status',1)->select();
        	$this->assign('userGroup',$userGroup);
            return view('add',$userGroup);
        }

        $data = request()->except(['repassword','group_id']);
        $data['addtime'] = time();
        $data['password'] = md5('###'.input('post.password'));
      	$group['uid'] = db('user')->insertGetId($data);
      	$group['group_id'] = input('group_id');
      	$id = db('auth_group_access')->insert($group);
      	$res = $id ? 1 : 0 ;
        return $res;
    }
    	
    //更新
	public function update() {
		if(request()->isGet()) {
			$vo = db('user')
				->alias('u')
				->join('__AUTH_GROUP_ACCESS__ a','u.id = a.uid')
				->where('id',input('id'))
				->field('u.*,a.group_id')
				->find();
			$this->assign('vo',$vo);
			$this->assign('group',db('auth_group')->select());
			return $this->fetch();
		}

		$data = request()->except(['repassword','group_id']);
		if ($data['password'] == '') {
			unset($data['password']);
		} else {
			$data['password'] = md5('###'.input('password'));
		}

		$res = db('user')->update($data);
		$g = db('auth_group_access')->where('uid',input('id'))->update(array('group_id'=>input('group_id')));
		$id = $g || $res;
		return $id; 
	}      


	public function delete() {
		if(empty(input('id'))) {
			return false;
		}

		$res = db('user')->delete(input('id'));	
		$id = $res ? 1 : 0;
		return $id;
	}
}

