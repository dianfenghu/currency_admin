<?php

namespace app\common\controller;

use app\common\controller\Appframe;

class Homebase extends Appframe
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

        //闭站开关
        if(empty(config('wwwset.on_off'))){
            exit(config('wwwset.offstr'));
        }
    }
    
}
