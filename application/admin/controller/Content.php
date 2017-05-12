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
use think\Db;
use think\Input;
use think\File;
class Content extends Adminbase
{
	/**
	 * [_initialize 初始化]
	 * @Author:   wuwu <15093565100@163.com>
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
        $data = Db::name('content')
			->alias('c')
			->join('__TYPE__ y','y.id = c.type')
			->field('y.name as typename,c.*')
			->select();
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
            $db = Db::name('type');
            $data = self::getnosontype(0,$db,'son');
            $this -> view -> listtype = $data;
            return view();
        }
		$result = $this->validate($this -> request -> post(), 'Content');
        if (true !== $result) {
            echo 0;
            return;
        } else {
			$data = $this -> request -> post();
			$data['addtime'] = time();
			$res = Db::name('content')->insert($data);
			echo $res;
        }
    }

	//文章缩略图
    public function content_img(){
        $file = request()->file('image');
        $info = $file->validate(['size'=>2000000,'ext'=>'jpg,png'])->move(ROOT_PATH . 'uploads');
        if($info){
            $data['path'] = $info->getSaveName();
            //存入数据库
            $data['info'] = '图片上传成功'; 
            $data['code'] = 1;
        }else{
            // 上传失败获取错误信息
            $data['code'] = 0;
            $data['error'] = $file->getError();
        }

        return json($data);
    }
    
    protected static function getnosontype($pid,$db,$son='son'){
        $map['pid'] = $pid;
        $type = $db -> where($map) -> select();
        if(!empty($type)){
            foreach($type as $k => $v){
                $type[$k][$son] = self::getnosontype($v['id'],$db,$son);
				if(empty($type[$k][$son])){
					unset($type[$k][$son]);
				}
            }
        }
        return $type;
    }

    //修改
    public function update(){
        if(!$this -> request -> isPost()){
            $id = $this -> request -> param('id');
            if(empty($id)){
                return $this -> show404();
            }
            $data = DB::name('content') -> find($id);
			$type = self::getnosontype(0,DB::name('type'),'son');
            $this -> view -> vo = $data;
            $this -> view -> listtype = $type;
            return view();
        }
        $data = $this -> request -> param();
        $this -> save('content',$data);
        echo 1;
        
    }

}

