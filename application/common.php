<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * [dd 断点打印]
 * @Author:   yzm<577462987@qq.com>
 * @DateTime: 2017-03-03T14:59:20+0800
 * @since:    1.0
 * @param     [type]                   $var 变量
 * @return    [type]                        打印
 */
function dd($var){
	halt($var);
}