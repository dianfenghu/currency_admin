<?php
// +----------------------------------------------------------------------
// | 文件说明：前台菜单  
// +----------------------------------------------------------------------
// | Author: wuwu <15093565100@163.com>
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Date: 2017-3-3
// +----------------------------------------------------------------------
namespace app\admin\controller;
use app\common\controller\Adminbase;
use think\Db;
class Nav extends Adminbase
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

	public function index() {
		$this->assign('nav',$this->getTree());
		return $this->fetch();
	}

	public function edit() {
		$id = request()->param('id');
		if(empty($id)) {
			return false;
		}

		$this->assign('nav',$this->getTree());
		$this->assign('data',Db::name('nav')->find($id));
		return $this->fetch();
	}
	
	public function add() {
		$nav = Db::name('nav')->select();
		$data = \tools\Data::tree($nav,'title','id');
		$this->assign('nav',$data);
		$this->assign('id',request()->param('id'));
		return $this->fetch();
	}

	public function update() {
		$result = $this->validate(request()->param(), 'Nav');
		if(true !== $result) {
			return false;
		}else {
			$data = request()->param();
			if(empty($data)) {
				return false;
			}
			
			if(empty($data['id'])) {
				$res = Db::name('nav')->insert($data);
			}else{
				$res = Db::name('nav')->update($data);
			}

			return $res;
		}
	}
    
	public function del() {
		$id = request()->param('id');
		if(empty($id)) {
			return false;
		}
		
		$children = Db::name('nav')->where('pid',$id)->count();
		if($children) {
			return json(array('code'=>'-1','info'=>'请先删除子类!'));
		}

		return Db::name('nav')->delete($id);
	}

	protected function getTree(){
		$nav = Db::name('nav')->select();
		$data = \tools\Data::tree($nav,'title','id');
		return $data;
	}
}
