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

class Type extends Adminbase
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
        $db = db('type');
        $data = $db -> select();
        $data = \tools\Data::tree($data,'name','id');
        // dd($data);
        $this -> view -> list = $data;  
        $dbb = \think\Db::name('type');
        $json = self::getmenu(0,$db,'children');
        $this -> view -> menutree = json_encode($json);
        return view();
    }

    //删除
    public function delete($id){
        $db = db('type');
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
                $this -> view -> pidname = db('type') -> where('id',$pid) -> value('name');
                $this -> view -> pid = $pid;
                return view('addzi');
            }   
        }

        $data = $this -> request -> post();

        if(empty($pid)){
            $data['pid'] = 0;
            $data['path'] = '0,';
        }else{
            $data['path'] = db('type') -> where('id='.$pid) -> value('path');
            $data['path'] .= $pid.',';
        }    
        
        $data['status'] = 1;
        //执行公共方法doadd 添加单条数据并返回id 
        $res = $this -> doadd('type',$data);
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
            $db = db('type');
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

        $this -> save('type',$data);
        return json($data);
        
    }       
}

