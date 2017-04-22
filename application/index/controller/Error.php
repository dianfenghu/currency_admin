<?php
namespace app\index\controller;

use think\Request;

class Error 
{
    /**
     * [_empty 空方法]
     * @Author:   yzm<577462987@qq.com>
     * @DateTime: 2017-03-03T09:59:30+0800
     * @since:    1.0
     * @param     [type]                   $name [description]
     * @return    [type]                         [description]
     */
    public function _empty($name)
    {
        return $this -> show404();
    }

    public function show404()
    {
    	header('HTTP/1.1 404 Not Found'); 
		header("status: 404 Not Found"); 
		return view('common@Public:404');
    }
}