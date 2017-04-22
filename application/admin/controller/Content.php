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

class Content extends Adminbase
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

    //后台自定义菜单列表页
    public function index()
    {
        $db = db('content');
        $data = $db -> select();
        $this -> view -> list = $data;  
        return view();
    }

    //删除
    public function delete($id){
        $db = db('content');
        if($db -> delete($id)){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    //添加
    public function add(){
        if(!$this -> request -> isPost()){
            $db = \think\Db::name('type');
            $data = self::getnosontype(0,$db,'son');
            dd($data);
            $this -> view -> listtype = $data;
            return view();
        }

        $data = $this -> request -> post();  
        $data['status'] = 1;
        if($data['type']){

        }
        //执行公共方法doadd 添加单条数据并返回id 
        $res = $this -> doadd('content',$data);
        if($res){
            $data['id'] = $res;
            return json($data);
        }
        return json(0);
    }
    
    protected static function getnosontype($pid,$db,$son='son'){
        $map['pid'] = $pid;
        $type = $db -> where($map) -> select();
        if(!empty($type)){
            foreach($type as $k => $v){
                $data = self::getnosontype($v['id'],$db,$son);
                if(empty($data)){
                    unset($data[$k]);
                }
            }
        }
        return $data;
    }

    //修改
    public function update(){
        if(!$this -> request -> isPost()){
            $id = $this -> request -> param('id');
            if(empty($id)){
                return $this -> show404();
            }
            $db = db('content');
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

        $this -> save('content',$data);
        return json($data);
        
    }
}

