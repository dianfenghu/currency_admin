<?php
namespace app\admin\validate;
use think\Validate;

class Nav extends Validate
{
	   protected $rule = [
        'title'  =>  'require|max:25',
        'sort' =>  'require',
    ];

	   
    protected $message = [
        'title.require' => '菜单名称',
        'sort' => '排序值不能为空',
    ];


}