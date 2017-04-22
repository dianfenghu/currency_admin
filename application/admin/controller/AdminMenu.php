<?php
// +----------------------------------------------------------------------
// | 文件说明：后台菜单  
// +----------------------------------------------------------------------
// | Author: wuwu <15093565100@163.com>
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Date: 2017-3-3
// +----------------------------------------------------------------------
namespace app\admin\controller;
use app\common\controller\Adminbase;

class AdminMenu extends Adminbase
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

    //获取后台自定义菜单
    protected static function getmenutree($pid,$db,$son){
        $res = $db -> where('pid',$pid) -> select();
        if(!empty($res)){
            foreach ($res as $key => $value) {
                $res[$key][$son] = self::getmenu($value['id'],$db,$son);
            }
        }
        
        return $res;
    }

    //后台自定义菜单列表页
    public function index()
    {
    	$db = db('admin_menu');
        $dbb = \think\Db::name('admin_menu');
    	$data = $db -> select();
        $data = \tools\Data::tree($data,'name','id');
    	$this -> view -> list = $data;
        $arr = self::getmenutree(0,$dbb,'children');
        $json = json_encode($arr);
        $this -> view -> menutree = $json;
		return view();
    }

    //删除
    public function delete($id){
    	$db = db('admin_menu');
    	if($db -> delete($id)){
    		echo 1;
    	}else{
    		echo 0;
    	}
    }
	
	//添加
    public function add(){
        $pid = $this -> request -> param('pid');
    	if(!$this -> request -> isPost()){
    		if(empty($pid)){
	    		return view();
	    	}else{
                $this -> view -> pidname = db('admin_menu')-> where('id='.$pid) -> value('name');
                $this -> view -> pid = $pid;
	    		return view('addzi');
	    	}  	
    	}

    	$data = $this -> request -> post();

    	if(empty($pid)){
    		$data['pid'] = 0;
            $data['path'] = '0,';
    	}else{
            $pidres = db('admin_menu') -> where('id',$pid) -> value('pid');
            if('0' != $pidres){
                return json(0);
            }
            $data['path'] = db('type') -> where('id='.$pid) -> value('path');
            $data['path'] .= $pid.',';
        }
        
    	$data['type'] = 1;
    	$data['status'] = 1;
    	$data['sort'] = 0;
    	//执行公共方法doadd 添加单条数据并返回id 
    	$res = $this -> doadd('admin_menu',$data);
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
            $db = db('admin_menu');
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

        $this -> save('admin_menu',$data);
        return json($data);
    	
    }

    
}
