<?php
// +----------------------------------------------------------------------
// | 文件说明：后台首页  
// +----------------------------------------------------------------------
// | Author: wuwu <15093565100@163.com>
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Date: 2017-3-3
// +----------------------------------------------------------------------
namespace app\admin\controller;
use app\common\controller\Adminbase;

class Index extends Adminbase
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

    /**
     * [index 首页]
     * @Author:   yzm<577462987@qq.com>
     * @DateTime: 2017-03-03T14:37:27+0800
     * @since:    1.0
     * @return                       首页
     */
    public function index()
    {
       return view();
    }

    /**
     * [wwwset 网站设置]
     * @Author:   yzm<577462987@qq.com>
     * @DateTime: 2017-03-04T11:07:59+0800
     * @since:    1.0
     * @return    [type]                   设置
     */
    public function wwwset(){
        //不是POST加载视图
        if (!$this -> request ->isPost()){
            $view = $this->view;
            $view -> on_off = config('wwwset.on_off');          
            return view();
        }
        
        $str = <<<EOF
<?php
return [
    'on_off' => '{$this -> request -> post('on_off')}',
    'offstr' => '{$this -> request -> post('offstr')}',
];
EOF;
        file_put_contents(CONF_PATH.'extra/wwwset.php',$str);
        $this->success('保存成功');
    }

   
}

